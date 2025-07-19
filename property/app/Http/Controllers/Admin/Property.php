<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use App\Models\Property_model;
use App\Models\Staff_model;

class Property extends Controller
{
    // Main page
    public function index()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	$myproperty 	    = new Property_model();
		$property 			= $myproperty->semua();
        $tipe               = 'all';
		$kategori_property  = DB::table('kategori_property')->orderBy('urutan','ASC')->get();

		$data = array(  'title'				=> 'Data Property',
						'property'		    => $property,
						'kategori_property'	=> $kategori_property,
                        'tipe'              => $tipe,
                        'content'			=> 'admin/property/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Main page
    public function detail($id_property)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproperty = new Property_model();
        $property   = $myproperty->detail($id_property);
        $images     = DB::table('property_img')->where('id_property',$property->id_property)->orderBy('id_property_img')->get();
        $mystaff        = new Staff_model();
        $staff          = $mystaff->detail($property->id_staff);

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        $data = array(  'title'             => $property->nama_property,
                        'property'          => $property,
                        'gambar'            => $gambar,
                        'staff'             => $staff,
                        'content'           => 'admin/property/detail'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproperty        = new Property_model();
        $keywords          = $request->keywords;
        $tipe              = $request->tipe;
        $property          = $myproperty->cari($keywords,$tipe);
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();
        $data = array(  'title'             => 'Data Property',
                        'property'          => $property,
                        'tipe'              => $tipe,
                        'kategori_property' => $kategori_property,
                        'content'           => 'admin/property/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        $site = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_property = $request->id_property;
            for($i=0; $i < sizeof($id_property);$i++) {
                DB::table('property_db')->where('id_property',$id_property[$i])->delete();
            }
            return redirect('admin/property')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }elseif(isset($_POST['update'])) {
            $id_property = $request->id_property;
            for($i=0; $i < sizeof($id_property);$i++) {
                DB::table('property_db')->where('id_property',$id_property[$i])->update([
                        'id_property'          => Session()->get('id_property'),
                        'id_kategori_property' => $request->id_kategori_property
                    ]);
            }
            return redirect('admin/property')->with(['sukses' => 'Data kategori telah diubah']);
        }
    }

    //Kategori
    public function kategori($id_kategori_property)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproperty        = new Property_model();
        $property          = $myproperty->all_kategori_property($id_kategori_property);
        $tipe              = 'all';
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Data Property',
                        'property'          => $property,
                        'tipe'              => $tipe,
                        'kategori_property' => $kategori_property,
                        'content'           => 'admin/property/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();
        $staff = DB::table('staff')->orderBy('nama_staff','ASC')->get();
        $provinsi = DB::table('provinsi')->orderBy('nama','ASC')->get();

        $data = array(  'title'             => 'Tambah Property',
                        'kategori_property' => $kategori_property,
                        'provinsi'          => $provinsi,
                        'staff'             => $staff,
                        'content'           => 'admin/property/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_property)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproperty        = new Property_model();
        $property          = $myproperty->detail($id_property);
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();
        $staff             = DB::table('staff')->orderBy('nama_staff','ASC')->get();
        $images     = DB::table('property_img')->where('id_property',$property->id_property)->orderBy('id_property_img')->get();
        $provinsi   = DB::table('provinsi')->orderBy('nama','ASC')->get();
        $kabupaten  = DB::table('kabupaten')->where('id_provinsi',$property->id_provinsi)->orderBy('nama','ASC')->get();
        $kecamatan  = DB::table('kecamatan')->where('id_kabupaten',$property->id_kabupaten)->orderBy('nama','ASC')->get();

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        for($i=0;$i<10;$i++) {
            $gambar_v[$i] = isset($gambar[$i]) ? $gambar[$i]->gambar : ''; 
        }

        $data = array(  'title'             => 'Edit Property',
                        'property'          => $property,
                        'kategori_property' => $kategori_property,
                        'provinsi'          => $provinsi,
                        'kabupaten'         => $kabupaten,
                        'kecamatan'         => $kecamatan,
                        'gambar'            => $gambar_v,
                        'staff'             => $staff,
                        'content'           => 'admin/property/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        request()->validate([
                    'kode'          => 'required|unique:property_db',
                    'nama_property' => 'required|unique:property_db',
                    'lt'            => 'required|numeric',
                    'lb'            => 'required|numeric',
                    'harga'         => 'required|numeric',
                    'id_provinsi'   => 'required',
                    'id_kabupaten'  => 'required',
                    'id_kecamatan'  => 'required',
                    'harga'         => 'required|numeric',
                    'lantai'        => 'numeric',
                    'keywords'      => 'required',
                ]);
        
        $slug_property = Str::slug($request->nama_property);
        $id_property = DB::table('property_db')->insertGetId([
            'id_kategori_property' => $request->id_kategori_property,
            'kode'                 => $request->kode,
            'slug_property'        => $slug_property,
            'nama_property'        => $request->nama_property,
            'tipe'                 => $request->tipe,
            'jenis_sewa'           => $request->jenis_sewa,
            'harga'                => $request->harga,
            'status'               => $request->status,
            'surat'                => $request->surat,
            'lt'                   => $request->lt,
            'lb'                   => $request->lb,
            'isi'                  => $request->isi,
            'kamar_tidur'          => $request->kamar_tidur,
            'kamar_mandi'          => $request->kamar_mandi,
            'lantai'               => $request->lantai,
            'id_staff'             => $request->id_staff,
            'alamat'               => $request->alamat,
            'id_provinsi'          => $request->id_provinsi,
            'id_kabupaten'         => $request->id_kabupaten,
            'id_kecamatan'         => $request->id_kecamatan,
            'keywords'             => $request->keywords
        ]);

        // UPLOAD START
        $images = $request->file('gambar');
        foreach($request->gambar as $key => $val) {
            $image = $images[$key]; 
            if(!empty($image)) {
                $filenamewithextension  = $image->getClientOriginalName();
                $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = './assets/upload/property/';
                $image->move($destinationPath, $input['nama_file']);
            }

            DB::table('property_img')->insert([
                'id_property'   => $id_property,
                'gambar'        => $input['nama_file'],
                'index_img'     => $key
            ]);
        }
        
        // END UPLOAD

        return redirect('admin/property')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit_proses(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        request()->validate([
                                'kode'          => 'required',
                                'nama_property' => 'required',
                                'lt'            => 'required|numeric',
                                'lb'            => 'required|numeric',
                                'harga'         => 'required|numeric',
                                'id_provinsi'   => 'required',
                                'id_kabupaten'  => 'required',
                                'id_kecamatan'  => 'required',
                                'harga'         => 'required|numeric',
                                'lantai'        => 'numeric',
                                'keywords'      => 'required',
                            ]);
       
        $slug_property = Str::slug($request->nama_property);
        DB::table('property_db')->where('id_property',$request->id_property)->update([
            'id_kategori_property' => $request->id_kategori_property,
            'kode'                 => $request->kode,
            'slug_property'        => $slug_property,
            'nama_property'        => $request->nama_property,
            'tipe'                 => $request->tipe,
            'jenis_sewa'           => $request->jenis_sewa,
            'harga'                => $request->harga,
            'status'               => $request->status,
            'surat'                => $request->surat,
            'lt'                   => $request->lt,
            'lb'                   => $request->lb,
            'isi'                  => $request->isi,
            'kamar_tidur'          => $request->kamar_tidur,
            'kamar_mandi'          => $request->kamar_mandi,
            'lantai'               => $request->lantai,
            'id_staff'             => $request->id_staff,
            'alamat'               => $request->alamat,
            'id_provinsi'          => $request->id_provinsi,
            'id_kabupaten'         => $request->id_kabupaten,
            'id_kecamatan'         => $request->id_kecamatan,
            'keywords'             => $request->keywords
        ]);
        
        // UPLOAD START
        $images = $request->file('gambar');
        if($request->gambar) {
            foreach($request->gambar as $key => $val) {
                $image = $images[$key]; 
                if(!empty($image)) {
                    $filenamewithextension  = $image->getClientOriginalName();
                    $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                    $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = './assets/upload/property/';
                    $image->move($destinationPath, $input['nama_file']);
                }

                DB::table('property_img')->updateOrInsert([
                    'id_property'   => $request->id_property,
                    'index_img'     => $key
                ],[
                    'gambar'        => $input['nama_file']
                ]);
            }
        }
        
        // END UPLOAD    

        return redirect('admin/property')->with(['sukses' => 'Data telah ditambah']);
    }

    // Delete
    public function delete($id_property)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('property_db')->where('id_property',$id_property)->delete();
        DB::table('property_img')->where('id_property',$id_property)->delete();
        return redirect('admin/property')->with(['sukses' => 'Data telah dihapus']);
    }
}
