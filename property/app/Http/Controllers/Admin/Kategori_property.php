<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Kategori_property extends Controller
{
    // Index
    public function index()
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
		$kategori_property 	= DB::table('kategori_property')->orderBy('urutan','ASC')->get();

		$data = array(  'title'             => 'Kategori Property',
						'kategori_property'	=> $kategori_property,
                        'content'           => 'admin/kategori_property/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
                'nama_kategori_property' => 'required|unique:kategori_property',
                'urutan' 		         => 'required',
            ]);
    	$slug_kategori_property = Str::slug($request->nama_kategori_property, '-');
        DB::table('kategori_property')->insert([
            'nama_kategori_property' => $request->nama_kategori_property,
            'slug_kategori_property' => $slug_kategori_property,
            'keterangan'             => $request->keterangan,
            'urutan'   		         => $request->urutan
        ]);
        return redirect('admin/kategori_property')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit
    public function edit(Request $request)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	request()->validate([
                'nama_kategori_property' => 'required',
                'urutan'                 => 'required',
            ]);
    	$slug_kategori_property = Str::slug($request->nama_kategori_property, '-');
        DB::table('kategori_property')->where('id_kategori_property',$request->id_kategori_property)->update([
            'nama_kategori_property' => $request->nama_kategori_property,
            'slug_kategori_property' => $slug_kategori_property,
            'keterangan'             => $request->keterangan,
            'urutan'                 => $request->urutan
        ]);
        return redirect('admin/kategori_property')->with(['sukses' => 'Data telah diupdate']);
    }

    // Delete
    public function delete($id_kategori_property)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
    	DB::table('kategori_property')->where('id_kategori_property',$id_kategori_property)->delete();
    	return redirect('admin/kategori_property')->with(['sukses' => 'Data telah dihapus']);
    }
}
