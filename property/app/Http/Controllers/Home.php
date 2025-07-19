<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Rekening_model;
use App\Models\Berita_model;
use App\Models\Staff_model;
use App\Models\Download_model;
use App\Models\Property_model;
use App\Models\Proyek_model;
use PDF;

class Home extends Controller
{
    // Homepage
    public function index()
    {
    	$site_config   = DB::table('konfigurasi')->first();
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();
        $video          = DB::table('video')->orderBy('id_video','DESC')->first();
    	$slider         = DB::table('galeri')->where('jenis_galeri','Homepage')->limit(5)->orderBy('id_galeri', 'DESC')->get();
        $layanan        = DB::table('berita')->where(array('jenis_berita'=>'Layanan','status_berita'=>'Publish'))->limit(3)->orderBy('urutan', 'ASC')->get();
        $news           = new Berita_model();
        $myproperty     = new Property_model();
        $berita         = $news->home();

        $property = $myproperty->semua_raw();
        $property = $property->orderByRaw('property_db.tanggal desc')->paginate(6);

        $data = array(  'title'         => $site_config->namaweb.' - '.$site_config->tagline,
                        'deskripsi'     => $site_config->namaweb.' - '.$site_config->tagline,
                        'keywords'      => $site_config->namaweb.' - '.$site_config->tagline,
                        'slider'        => $slider,
                        'site_config'   => $site_config,
                        'properties'    => $property,
                        'berita'        => $berita,
                        'beritas'       => $berita,
                        'layanan'       => $layanan,
                        'video'         => $video,
                        'kategori_property' => $kategori_property,
                        'content'       => 'home/index'
                    );
        return view('layout/wrapper',$data);
    }

    public function search($tipe, Request $request)
    {
    	$site_config   = DB::table('konfigurasi')->first();
        $kategori_property = DB::table('kategori_property')->orderBy('urutan','ASC')->get();
        $news           = new Berita_model();
        $myproperty     = new Property_model();
        $berita         = $news->home();

        //Filter
        $id_kategori_property = $request->id_kategori_property;
        $listing_type       = ($tipe=='jual') ? '1' : '2'; 
        $location           = $request->location;
        $price_from         = $request->price_from;
        $price_to           = $request->price_to;
        $bedrooms           = $request->bedrooms;
        $bathrooms          = $request->bathrooms;
        $landsize_from      = $request->landsize_from;
        $landsize_to        = $request->landsize_to;
        $buildingsize_from  = $request->buildingsize_from;
        $buildingsize_to    = $request->buildingsize_to;
        $certificates       = $request->certificates;
        $limit              = ($request->limit) ? $request->limit : '9';
        $order              = ($request->order) ? $request->order : 'newest';
       
        switch ($order) {
            case 'newest':
                $orderData = 'property_db.tanggal desc';
                break;
            case 'price_desc':
                $orderData = 'property_db.harga desc';
                break;
            case 'price_asc':
                $orderData = 'property_db.harga';
                break;
            default:
                $orderData = 'property_db.tanggal';
          }

        $priceArray = [50000000,100000000,500000000,1000000000,3000000000,5000000000,7000000000,10000000000,15000000000,20000000000,30000000000,50000000000,75000000000,100000000000];
        $bedroomArray   = [1,2,3,4];
        $bathroomsArray = [1,2,3,4,5,6];
        $certificatesArray = ['SHM' => 'SHM - Sertifikat Hak Milik','HGB' => 'HGB - Hak Guna Bangunan','other' => 'Lainnya (PPJB, Girik, Adat, dll)'];
        $limit          = $limit;

        $where = array(
            'property_db.tipe' => $tipe,
        );  

        $property = $myproperty->semua_raw($where);
        if($location != '') {
            $item = explode(", ",$location);
            if(count($item) >= 3 ) {
                $kecamatan = strtolower($item[0]);
                $kabupaten = strtolower($item[1]);
                $provinsi = strtolower($item[2]);

                $whereRaw = " (LOWER(kecamatan.nama) LIKE '%".$kecamatan."%' AND LOWER(kabupaten.nama) LIKE '%".$kabupaten."%' AND LOWER(provinsi.nama) LIKE '%".$provinsi."%') ";
            }
            else if(count($item) == 2 ) {
                $kabupaten = $item[0];
                $provinsi = $item[1];

                $whereRaw = " (LOWER(kabupaten.nama) LIKE '%".$kabupaten."%' AND LOWER(provinsi.nama) LIKE '%".$provinsi."%') ";
            }
            else if(count($item) == 1 ) {
                $item = $item[0];
                $whereRaw = " (LOWER(kecamatan.nama) LIKE '%".$item."%' OR LOWER(kabupaten.nama) LIKE '%".$item."%' OR LOWER(provinsi.nama) LIKE '%".$item."%') ";
            }
            
            $property->whereRaw($whereRaw);
        }
        if($id_kategori_property != '') {
            $property->where('property_db.id_kategori_property',$id_kategori_property);
        }
        if($price_from > 0 && $price_to > 0) {
            $property->whereBetween('property_db.harga', [$price_from, $price_to]);
        }
        if($bedrooms != '') {
            if($bedrooms != '5+') {
                $property->where('property_db.kamar_tidur',$bedrooms);
            } else {
                $property->where('property_db.kamar_tidur','>=',5);
            }
        }
        if($bathrooms != '') {
            if($bathrooms != '7+') {
                $property->where('property_db.kamar_mandi',$bathrooms);
            } else {
                $property->where('property_db.kamar_mandi','>=',7);
            }
        }
        if($landsize_from >= 0 && $landsize_to > 0 ) {
            $property->whereBetween('property_db.lt', [$landsize_from, $landsize_to]);
        }
        if($buildingsize_from >= 0 && $buildingsize_to > 0) {
            $property->whereBetween('property_db.lb', [$buildingsize_from, $buildingsize_to]);
        }
        if($certificates != '') {
            $property->where('property_db.surat',$certificates);
        }
        $property = $property->orderByRaw($orderData)->paginate($limit);

        $data = array(  'title'         => $site_config->namaweb.' - '.$site_config->tagline,
                        'deskripsi'     => $site_config->namaweb.' - '.$site_config->tagline,
                        'keywords'      => $site_config->namaweb.' - '.$site_config->tagline,
                        'site_config'   => $site_config,
                        'berita'        => $berita,
                        'properties'    => $property,
                        'priceArray'    => $priceArray,
                        'bedroomArray'  => $bedroomArray,
                        'bathroomsArray'=> $bathroomsArray,
                        'certificatesArray' => $certificatesArray,
                        'kategori_property'     => $kategori_property,
                        'id_kategori_property'  => $id_kategori_property,
                        'listing_type'          => $listing_type,
                        'location'              => $location,
                        'price_from'            => $price_from,
                        'price_to'              => $price_to,
                        'bedrooms'              => $bedrooms,
                        'bathrooms'             => $bathrooms,
                        'landsize_from'         => $landsize_from,
                        'landsize_to'           => $landsize_to,
                        'buildingsize_from'     => $buildingsize_from,
                        'buildingsize_to'       => $buildingsize_to,
                        'certificates'          => $certificates,
                        'limit'         => $limit,
                        'order'         => $order,
                        'content'       => 'home/search'
                    );
        return view('layout/wrapper',$data);
    }

    public function search_kontraktor($tipe, Request $request)
    {
    	$site_config  = DB::table('konfigurasi')->first();
        $news         = new Berita_model();
        $myproyek     = new Proyek_model();
        $berita       = $news->home();
        
        //Filter
        $listing_type       = ($tipe=='done') ? '1' : '2'; 
        $location           = $request->location;
        $landsize_from      = $request->landsize_from;
        $landsize_to        = $request->landsize_to;
        $buildingsize_from  = $request->buildingsize_from;
        $buildingsize_to    = $request->buildingsize_to;
        $limit              = ($request->limit) ? $request->limit : '9';
        $order              = ($request->order) ? $request->order : 'newest';
       
        switch ($order) {
            case 'newest':
                $orderData = 'proyek.tanggal desc';
                break;
            default:
                $orderData = 'proyek.tanggal desc';
          }

        $limit          = $limit;

        $where = array(
            'proyek.tipe' => $tipe,
        );  

        $proyek = $myproyek->semua_raw($where);
        if($location != '') {
            $item = explode(", ",$location);
            if(count($item) >= 3 ) {
                $kecamatan = strtolower($item[0]);
                $kabupaten = strtolower($item[1]);
                $provinsi = strtolower($item[2]);

                $whereRaw = " (LOWER(kecamatan.nama) LIKE '%".$kecamatan."%' AND LOWER(kabupaten.nama) LIKE '%".$kabupaten."%' AND LOWER(provinsi.nama) LIKE '%".$provinsi."%') ";
            }
            else if(count($item) == 2 ) {
                $kabupaten = $item[0];
                $provinsi = $item[1];

                $whereRaw = " (LOWER(kabupaten.nama) LIKE '%".$kabupaten."%' AND LOWER(provinsi.nama) LIKE '%".$provinsi."%') ";
            }
            else if(count($item) == 1 ) {
                $item = $item[0];
                $whereRaw = " (LOWER(kecamatan.nama) LIKE '%".$item."%' OR LOWER(kabupaten.nama) LIKE '%".$item."%' OR LOWER(provinsi.nama) LIKE '%".$item."%') ";
            }
            
            $proyek->whereRaw($whereRaw);
        }
        if($landsize_from >= 0 && $landsize_to > 0 ) {
            $proyek->whereBetween('proyek.lt', [$landsize_from, $landsize_to]);
        }
        if($buildingsize_from >= 0 && $buildingsize_to > 0) {
            $proyek->whereBetween('proyek.lb', [$buildingsize_from, $buildingsize_to]);
        }
        $proyek = $proyek->orderByRaw($orderData)->paginate($limit);

        $data = array(  'title'         => $site_config->namaweb.' - '.$site_config->tagline,
                        'deskripsi'     => $site_config->namaweb.' - '.$site_config->tagline,
                        'keywords'      => $site_config->namaweb.' - '.$site_config->tagline,
                        'site_config'   => $site_config,
                        'berita'        => $berita,
                        'projects'      => $proyek,
                        'listing_type'          => $listing_type,
                        'location'              => $location,
                        'landsize_from'         => $landsize_from,
                        'landsize_to'           => $landsize_to,
                        'buildingsize_from'     => $buildingsize_from,
                        'buildingsize_to'       => $buildingsize_to,
                        'limit'         => $limit,
                        'order'         => $order,
                        'content'       => 'home/search_kontraktor'
                    );
        return view('layout/wrapper',$data);
    }

    public function properti($id_property)
    {
        $site_config    = DB::table('konfigurasi')->first();
        
        $myproperty     = new Property_model();
        $property       = $myproperty->detail($id_property);
        $images         = DB::table('property_img')->where('id_property',$property->id_property)->orderBy('index_img')->get();
        $mystaff        = new Staff_model();
        $staff          = $mystaff->detail($property->id_staff);
        $news           = new Berita_model();
        $berita         = $news->home();

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        $data = array(  'title'             => $property->slug_property,
                        'deskripsi'         => $property->nama_property,
                        'keywords'          => $site_config->namaweb.' - '.$site_config->tagline,
                        'site_config'       => $site_config,
                        'berita'            => $berita,
                        'property'          => $property,
                        'images'            => $images,
                        'staff'             => $staff,

                        'og_site_name'      => strtolower(str_replace(' ','',$site_config->namaweb)),
                        'og_title'          => $staff->nama_staff,
                        'og_image'          => asset('assets/upload/property/'.$img->gambar),
                        'og_description'    => 'Agent of '.$site_config->namaweb,
                        'og_url'            => asset('agent/'.$staff->id_staff),

                        'content'           => 'home/properti'
                    );
        return view('layout/wrapper',$data);
    }

    public function proyek($id_proyek)
    {
        $site_config    = DB::table('konfigurasi')->first();
        
        $myproyek       = new Proyek_model();
        $proyek         = $myproyek->detail($id_proyek);
        $images         = DB::table('proyek_img')->where('id_proyek',$proyek->id_proyek)->orderBy('index_img')->get();
        $news           = new Berita_model();
        $berita         = $news->home();

        $gambar = [];
        foreach($images as $key => $img) {
            $gambar[$key] = $img;
        }

        $data = array(  'title'             => $proyek->slug_proyek,
                        'deskripsi'         => $proyek->nama_proyek,
                        'keywords'          => $site_config->namaweb.' - '.$site_config->tagline,
                        'site_config'       => $site_config,
                        'berita'            => $berita,
                        'proyek'            => $proyek,
                        'images'            => $images,
                        'staff'             => DB::table('staff')->first(),

                        'content'           => 'home/proyek'
                    );
        return view('layout/wrapper',$data);
    }

    public function agent($id_staff, Request $request)
    {
        $site_config    = DB::table('konfigurasi')->first();
        
        $mystaff        = new Staff_model();
        $staff          = $mystaff->detail($id_staff);
        $myproperty     = new Property_model();
        $news           = new Berita_model();
        $berita         = $news->home();
        $limit          = ($request->limit) ? $request->limit : '9';
        $order          = ($request->order) ? $request->order : 'newest';
       
        switch ($order) {
            case 'newest':
                $orderData = 'property_db.tanggal';
                break;
            case 'price_desc':
                $orderData = 'property_db.harga desc';
                break;
            case 'price_asc':
                $orderData = 'property_db.harga';
                break;
            default:
                $orderData = 'property_db.tanggal';
          }

        $where = array(
            'property_db.id_staff' => $id_staff,
        );  

        $property = $myproperty->semua_raw($where);
        $property = $property->orderByRaw($orderData)->paginate($limit);

        $data = array(  'title'             => $staff->slug_staff,
                        'deskripsi'         => $staff->nama_staff,
                        'keywords'          => $site_config->namaweb.' - '.$site_config->tagline,
                        'site_config'       => $site_config,
                        'berita'            => $berita,
                        'properties'        => $property,
                        'staff'             => $staff,
                        'limit'             => $limit,
                        'order'             => $order,

                        'og_site_name'      => strtolower(str_replace($site_config->namaweb,'',' ')),
                        'og_title'          => $staff->nama_staff,
                        'og_image'          => ($staff->gambar!="") ? asset('assets/upload/staff/thumbs/'.$staff->gambar) : asset('assets/aws/images/no-profile.png'),
                        'og_description'    => 'Agent of '.$site_config->namaweb,
                        'og_url'            => asset('agent/'.$staff->id_staff),

                        'content'           => 'home/agent'
                    );
        return view('layout/wrapper',$data);
    }


    // Homepage
    public function about()
    {
        $site_config   = DB::table('konfigurasi')->first();
        $news   = new Berita_model();
        $berita = $news->home();
        // Staff
        $kategori_staff  = DB::table('kategori_staff')->orderBy('urutan','ASC')->get();
        $layanan = DB::table('berita')->where(array('jenis_berita' => 'Layanan','status_berita' => 'Publish'))->orderBy('urutan', 'ASC')->get();

        $data = array(  'title'     => 'Tentang '.$site_config->namaweb,
                        'deskripsi' => 'Tentang '.$site_config->namaweb,
                        'keywords'  => 'Tentang '.$site_config->namaweb,
                        'site_config'      => $site_config,
                        'berita'    => $berita,
                        'layanan'   => $layanan,
                        'kategori_staff'     => $kategori_staff,
                        'content'   => 'home/aws'
                    );
        return view('layout/wrapper',$data);
    }

    public function about_project()
    {
        $site_config   = DB::table('konfigurasi')->first();
        $news   = new Berita_model();
        $berita = $news->home();
        // Staff
        $kategori_staff  = DB::table('kategori_staff')->orderBy('urutan','ASC')->get();
        $layanan = DB::table('berita')->where(array('jenis_berita' => 'Layanan','status_berita' => 'Publish'))->orderBy('urutan', 'ASC')->get();

        $data = array(  'title'     => 'Tentang '.$site_config->namaweb,
                        'deskripsi' => 'Tentang '.$site_config->namaweb,
                        'keywords'  => 'Tentang '.$site_config->namaweb,
                        'site_config'      => $site_config,
                        'berita'    => $berita,
                        'layanan'   => $layanan,
                        'kategori_staff'     => $kategori_staff,
                        'content'   => 'home/aws_project'
                    );
        return view('layout/wrapper',$data);
    }

    // kontak
    public function kontak()
    {
        $site_config   = DB::table('konfigurasi')->first();

        $data = array(  'title'     => 'Menghubungi '.$site_config->namaweb,
                        'deskripsi' => 'Kontak '.$site_config->namaweb,
                        'keywords'  => 'Kontak '.$site_config->namaweb,
                        'site_config'      => $site_config,
                        'content'   => 'home/kontak'
                    );
        return view('layout/wrapper',$data);
    }

}
