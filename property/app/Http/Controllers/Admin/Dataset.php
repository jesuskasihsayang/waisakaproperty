<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class Dataset extends Controller
{
    public function kabupaten($provinsi_id)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
		$kabupaten 	= DB::table('kabupaten')->where('id_provinsi',$provinsi_id)->orderBy('nama','ASC')->get();

        return $kabupaten->toJson();
    }

    public function kecamatan($kabupaten_id)
    {
    	if(Session()->get('username')=="") { return redirect('login')->with(['warning' => 'Mohon maaf, Anda belum login']);}
		$kecamatan 	= DB::table('kecamatan')->where('id_kabupaten',$kabupaten_id)->orderBy('nama','ASC')->get();

        return $kecamatan->toJson();
    }
}
