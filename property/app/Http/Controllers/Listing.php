<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Listing extends Controller
{

    public function location(Request $request)
    {
        $q = strtolower($request->q);
		$location 	= DB::table('kabupaten')
            ->join('provinsi', 'provinsi.id', '=', 'kabupaten.id_provinsi','LEFT')
            ->select('kabupaten.id','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten')
            ->whereRaw('LOWER(provinsi.nama) LIKE "%'.$q.'%" OR LOWER(kabupaten.nama) LIKE "%'.$q.'%"')
            ->orderBy('kabupaten.nama','ASC')->orderBy('provinsi.nama','ASC')
            ->get();
 
        $response = [];
        foreach($location as $location){
            $response[] = array($location->nama_kabupaten,$location->nama_provinsi);
        }

        echo json_encode($response);   
    }

}
