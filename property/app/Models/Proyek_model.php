<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proyek_model extends Model
{

	protected $table 		= "proyek";
	protected $primaryKey 	= 'id_proyek';

    // listing
    public function semua()
    {
        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->orderBy('proyek.id_proyek','DESC')
            ->get();
        return $query;
    }

    public function semua_raw($where)
    {
        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where($where);
        return $query;
    }

    // listing
    public function cari($keywords, $tipe = '')
    {
        if($tipe != '' && $tipe != 'all') {
            $whereTipe = " AND proyek.tipe = '".$tipe."' ";
        } else {
            $whereTipe = "";
        }

        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->whereRaw("(proyek.nama_proyek LIKE '%".$keywords."%' OR proyek.kode LIKE '%".$keywords."%' OR proyek.isi LIKE '%".$keywords."%') ".$whereTipe) 
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // listing
    public function listing()
    {
    	$query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where('status_proyek','Publish')
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function kategori_proyek($id_kategori_proyek)
    {
        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'proyek.status_proyek'         => 'Publish',
                            'proyek.id_kategori_proyek'    => $id_kategori_proyek))
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // Kategori
    public function kategori()
    {
         $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'proyek.status_proyek'         => 'Publish'))
            ->groupBy('proyek.id_kategori_proyek')
            ->orderBy('kategori_proyek.urutan','ASC')
            ->get();
        return $query;
    }

    // kategori
    public function all_kategori_proyek($id_kategori_proyek)
    {
        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'proyek.id_kategori_proyek'    => $id_kategori_proyek))
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function status_proyek($status_proyek)
    {
        $query = DB::table('proyek')
            ->join('kategori_proyek', 'kategori_proyek.id_kategori_proyek', '=', 'proyek.id_kategori_proyek','LEFT')
            ->select('proyek.*', 'kategori_proyek.slug_kategori_proyek', 'kategori_proyek.nama_kategori_proyek')
            ->where(array(  'proyek.status_proyek'         => $status_proyek))
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function detail_kategori_proyek($id_kategori_proyek)
    {
        $query = DB::table('proyek')
            ->join('kategori_proyek', 'kategori_proyek.id_kategori_proyek', '=', 'proyek.id_kategori_proyek','LEFT')
            ->select('proyek.*', 'kategori_proyek.slug_kategori_proyek', 'kategori_proyek.nama_kategori_proyek')
            ->where(array(  'proyek.status_proyek'         => 'Publish',
                            'proyek.id_kategori_proyek'    => $id_kategori_proyek))
            ->orderBy('id_proyek','DESC')
            ->first();
        return $query;
    }

    // kategori
    public function detail_slug_kategori_proyek($slug_kategori_proyek)
    {
        $query = DB::table('proyek')
            ->join('kategori_proyek', 'kategori_proyek.id_kategori_proyek', '=', 'proyek.id_kategori_proyek','LEFT')
            ->select('proyek.*', 'kategori_proyek.slug_kategori_proyek', 'kategori_proyek.nama_kategori_proyek')
            ->where(array(  'proyek.status_proyek'                  => 'Publish',
                            'kategori_proyek.slug_kategori_proyek'  => $slug_kategori_proyek))
            ->orderBy('id_proyek','DESC')
            ->first();
        return $query;
    }


    // kategori
    public function slug_kategori_proyek($slug_kategori_proyek)
    {
        $query = DB::table('proyek')
            ->join('kategori_proyek', 'kategori_proyek.id_kategori_proyek', '=', 'proyek.id_kategori_proyek','LEFT')
            ->select('proyek.*', 'kategori_proyek.slug_kategori_proyek', 'kategori_proyek.nama_kategori_proyek')
            ->where(array(  'proyek.status_proyek'                  => 'Publish',
                            'kategori_proyek.slug_kategori_proyek'  => $slug_kategori_proyek))
            ->orderBy('id_proyek','DESC')
            ->get();
        return $query;
    }

    // detail
    public function read($slug_proyek)
    {
        $query = DB::table('proyek')
            ->join('kategori_proyek', 'kategori_proyek.id_kategori_proyek', '=', 'proyek.id_kategori_proyek','LEFT')
            ->select('proyek.*', 'kategori_proyek.slug_kategori_proyek', 'kategori_proyek.nama_kategori_proyek')
            ->where('proyek.slug_proyek',$slug_proyek)
            ->orderBy('id_proyek','DESC')
            ->first();
        return $query;
    }

     // detail
    public function detail($id_proyek)
    {
        $query = DB::table('proyek')
            ->join('provinsi', 'provinsi.id', '=', 'proyek.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'proyek.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'proyek.id_kecamatan','LEFT')
            ->select('proyek.*','provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where('proyek.id_proyek',$id_proyek)
            ->orderBy('id_proyek','DESC')
            ->first();
        return $query;
    }

    // Gambar
    public function gambar($id_proyek)
    {
        $query = DB::table('proyek_img')
            ->select('*')
            ->where('proyek_img.id_proyek',$id_proyek)
            ->orderBy('id_proyek_img')
            ->get();
        return $query;
    }
}
