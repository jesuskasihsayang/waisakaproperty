<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;
use App\Models\Proyek_model;
use App\Models\Staff_model;

class Proyek extends Controller
{
    // Main page
    public function index()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	$myproyek 	        = new Proyek_model();
		$proyek 			= $myproyek->semua();
        $tipe               = 'all';

		$data = array(  'title'				=> 'Data Proyek',
						'proyek'		    => $proyek,
                        'tipe'              => $tipe,
                        'content'			=> 'admin/proyek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Main page
    public function detail($id_proyek)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproyek = new proyek_model();
        $proyek   = $myproyek->detail($id_proyek);
        $images     = DB::table('proyek_img')->where('id_proyek',$proyek->id_proyek)->orderBy('id_proyek_img')->get();

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        $data = array(  'title'             => $proyek->nama_proyek,
                        'proyek'            => $proyek,
                        'gambar'            => $gambar,
                        'content'           => 'admin/proyek/detail'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Cari
    public function cari(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproyek        = new proyek_model();
        $keywords        = $request->keywords;
        $tipe            = $request->tipe;
        $proyek          = $myproyek->cari($keywords,$tipe);
        $data = array(  'title'             => 'Data proyek',
                        'proyek'            => $proyek,
                        'tipe'              => $tipe,
                        'content'           => 'admin/proyek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Proses
    public function proses(Request $request)
    {
        $site = DB::table('konfigurasi')->first();
        // PROSES HAPUS MULTIPLE
        if(isset($_POST['hapus'])) {
            $id_proyek = $request->id_proyek;
            for($i=0; $i < sizeof($id_proyek);$i++) {
                DB::table('proyek')->where('id_proyek',$id_proyek[$i])->delete();
            }
            return redirect('admin/proyek')->with(['sukses' => 'Data telah dihapus']);
        // PROSES SETTING DRAFT
        }elseif(isset($_POST['update'])) {
            $id_proyek = $request->id_proyek;
            for($i=0; $i < sizeof($id_proyek);$i++) {
                DB::table('proyek')->where('id_proyek',$id_proyek[$i])->update([
                        'id_proyek'          => Session()->get('id_proyek'),
                        'id_kategori_proyek' => $request->id_kategori_proyek
                    ]);
            }
            return redirect('admin/proyek')->with(['sukses' => 'Data kategori telah diubah']);
        }
    }

    //Kategori
    public function kategori($id_kategori_proyek)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproyek        = new proyek_model();
        $proyek          = $myproyek->all_kategori_proyek($id_kategori_proyek);
        $tipe              = 'all';
        $kategori_proyek = DB::table('kategori_proyek')->orderBy('urutan','ASC')->get();

        $data = array(  'title'             => 'Data proyek',
                        'proyek'          => $proyek,
                        'tipe'              => $tipe,
                        'kategori_proyek' => $kategori_proyek,
                        'content'           => 'admin/proyek/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // Tambah
    public function tambah()
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $provinsi = DB::table('provinsi')->orderBy('nama','ASC')->get();

        $data = array(  'title'             => 'Tambah proyek',
                        'provinsi'          => $provinsi,
                        'content'           => 'admin/proyek/tambah'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_proyek)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        $myproyek        = new proyek_model();
        $proyek          = $myproyek->detail($id_proyek);
        $images     = DB::table('proyek_img')->where('id_proyek',$proyek->id_proyek)->orderBy('id_proyek_img')->get();
        $provinsi   = DB::table('provinsi')->orderBy('nama','ASC')->get();
        $kabupaten  = DB::table('kabupaten')->where('id_provinsi',$proyek->id_provinsi)->orderBy('nama','ASC')->get();
        $kecamatan  = DB::table('kecamatan')->where('id_kabupaten',$proyek->id_kabupaten)->orderBy('nama','ASC')->get();

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        for($i=0;$i<10;$i++) {
            $gambar_v[$i] = isset($gambar[$i]) ? $gambar[$i]->gambar : ''; 
        }

        $data = array(  'title'             => 'Edit proyek',
                        'proyek'            => $proyek,
                        'provinsi'          => $provinsi,
                        'kabupaten'         => $kabupaten,
                        'kecamatan'         => $kecamatan,
                        'gambar'            => $gambar_v,
                        'content'           => 'admin/proyek/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah_proses(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        request()->validate([
                    'kode'          => 'required|unique:proyek',
                    'nama_proyek'   => 'required|unique:proyek',
                    'lt'            => 'required|numeric',
                    'lb'            => 'required|numeric',
                    'lama_pengerjaan' => 'numeric',
                    'id_provinsi'   => 'required',
                    'id_kabupaten'  => 'required',
                    'id_kecamatan'  => 'required',
                    'keywords'      => 'required',
                ]);
        
        $slug_proyek = Str::slug($request->nama_proyek);
        $id_proyek = DB::table('proyek')->insertGetId([
            'kode'                 => $request->kode,
            'slug_proyek'          => $slug_proyek,
            'nama_proyek'          => $request->nama_proyek,
            'tipe'                 => $request->tipe,
            'lama_pengerjaan'      => $request->lama_pengerjaan,
            'lt'                   => $request->lt,
            'lb'                   => $request->lb,
            'isi'                  => $request->isi,
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
                $destinationPath = './assets/upload/proyek/';
                $image->move($destinationPath, $input['nama_file']);
            }

            DB::table('proyek_img')->insert([
                'id_proyek'     => $id_proyek,
                'gambar'        => $input['nama_file'],
                'index_img'     => $key
            ]);
        }
        
        // END UPLOAD

        return redirect('admin/proyek')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit_proses(Request $request)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        request()->validate([
                                'kode'          => 'required',
                                'nama_proyek'   => 'required',
                                'lt'            => 'required|numeric',
                                'lb'            => 'required|numeric',
                                'lama_pengerjaan' => 'numeric',
                                'id_provinsi'   => 'required',
                                'id_kabupaten'  => 'required',
                                'id_kecamatan'  => 'required',
                                'keywords'      => 'required',
                            ]);
       
        $slug_proyek = Str::slug($request->nama_proyek);
        DB::table('proyek')->where('id_proyek',$request->id_proyek)->update([
            'kode'                 => $request->kode,
            'slug_proyek'          => $slug_proyek,
            'nama_proyek'          => $request->nama_proyek,
            'tipe'                 => $request->tipe,
            'lama_pengerjaan'      => $request->lama_pengerjaan,
            'lt'                   => $request->lt,
            'lb'                   => $request->lb,
            'isi'                  => $request->isi,
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
                    $destinationPath = './assets/upload/proyek/';
                    $image->move($destinationPath, $input['nama_file']);
                }

                DB::table('proyek_img')->updateOrInsert([
                    'id_proyek'   => $request->id_proyek,
                    'index_img'     => $key
                ],[
                    'gambar'        => $input['nama_file']
                ]);
            }
        }
        
        // END UPLOAD    

        return redirect('admin/proyek')->with(['sukses' => 'Data telah ditambah']);
    }

    // Delete
    public function delete($id_proyek)
    {
        if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
        DB::table('proyek')->where('id_proyek',$id_proyek)->delete();
        DB::table('proyek_img')->where('id_proyek',$id_proyek)->delete();
        return redirect('admin/proyek')->with(['sukses' => 'Data telah dihapus']);
    }
}
