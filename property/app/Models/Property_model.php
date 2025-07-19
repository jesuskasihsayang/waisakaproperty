<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Property_model extends Model
{

	protected $table 		= "property_tb";
	protected $primaryKey 	= 'id_property';

    // listing
    public function semua()
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->selectRaw("(CASE WHEN property_db.status = 0 THEN CONCAT('belum ter',property_db.tipe) ELSE CONCAT('sudah ter',property_db.tipe) END) AS nama_status")
            ->orderBy('property_db.id_property','DESC')
            ->get();
        return $query;
    }

    public function semua_raw($where = [])
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where($where);
        return $query;
    }

    // listing
    public function cari($keywords, $tipe = '')
    {
        if($tipe != '' && $tipe != 'all') {
            $whereTipe = " AND property_db.tipe = '".$tipe."' ";
        } else {
            $whereTipe = "";
        }

        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
                ->selectRaw("(CASE WHEN property_db.status = 0 THEN CONCAT('belum ter',property_db.tipe) ELSE CONCAT('sudah ter',property_db.tipe) END) AS nama_status")
            ->whereRaw("(property_db.nama_property LIKE '%".$keywords."%' OR property_db.kode LIKE '%".$keywords."%' OR property_db.isi LIKE '%".$keywords."%') ".$whereTipe) 
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // listing
    public function listing()
    {
    	$query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where('status_property','Publish')
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function kategori_property($id_kategori_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'property_db.status_property'         => 'Publish',
                            'property_db.id_kategori_property'    => $id_kategori_property))
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // Kategori
    public function kategori()
    {
         $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'property_db.status_property'         => 'Publish'))
            ->groupBy('property_db.id_kategori_property')
            ->orderBy('kategori_property.urutan','ASC')
            ->get();
        return $query;
    }

    // kategori
    public function all_kategori_property($id_kategori_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where(array(  'property_db.id_kategori_property'    => $id_kategori_property))
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function status_property($status_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property')
            ->where(array(  'property_db.status_property'         => $status_property))
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // kategori
    public function detail_kategori_property($id_kategori_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property')
            ->where(array(  'property_db.status_property'         => 'Publish',
                            'property_db.id_kategori_property'    => $id_kategori_property))
            ->orderBy('id_property','DESC')
            ->first();
        return $query;
    }

    // kategori
    public function detail_slug_kategori_property($slug_kategori_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property')
            ->where(array(  'property_db.status_property'                  => 'Publish',
                            'kategori_property.slug_kategori_property'  => $slug_kategori_property))
            ->orderBy('id_property','DESC')
            ->first();
        return $query;
    }


    // kategori
    public function slug_kategori_property($slug_kategori_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property')
            ->where(array(  'property_db.status_property'                  => 'Publish',
                            'kategori_property.slug_kategori_property'  => $slug_kategori_property))
            ->orderBy('id_property','DESC')
            ->get();
        return $query;
    }

    // detail
    public function read($slug_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property')
            ->where('property_db.slug_property',$slug_property)
            ->orderBy('id_property','DESC')
            ->first();
        return $query;
    }

     // detail
    public function detail($id_property)
    {
        $query = DB::table('property_db')
            ->join('kategori_property', 'kategori_property.id_kategori_property', '=', 'property_db.id_kategori_property','LEFT')
            ->join('staff', 'staff.id_staff', '=', 'property_db.id_staff','LEFT')
            ->join('provinsi', 'provinsi.id', '=', 'property_db.id_provinsi','LEFT')
            ->join('kabupaten', 'kabupaten.id', '=', 'property_db.id_kabupaten','LEFT')
            ->join('kecamatan', 'kecamatan.id', '=', 'property_db.id_kecamatan','LEFT')
            ->select('property_db.*', 'kategori_property.slug_kategori_property', 'kategori_property.nama_kategori_property', 'staff.nama_staff', 
                'kategori_property.nama_kategori_property', 'provinsi.nama as nama_provinsi', 'kabupaten.nama as nama_kabupaten', 'kecamatan.nama as nama_kecamatan')
            ->where('property_db.id_property',$id_property)
            ->orderBy('id_property','DESC')
            ->first();
        return $query;
    }

    // Gambar
    public function gambar($id_property)
    {
        $query = DB::table('property_img')
            ->select('*')
            ->where('property_img.id_property',$id_property)
            ->orderBy('id_property_img')
            ->get();
        return $query;
    }
}
