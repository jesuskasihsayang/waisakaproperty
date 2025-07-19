<?php 
$bg   = DB::table('heading')->where('halaman','About')->orderBy('id_heading','DESC')->first();
 ?>
<!--Inner Header Start-->
<section class="wf100 p80 inner-header" style="background-image: url('{{ asset('assets/upload/image/'.$bg->gambar) }}'); background-position: bottom center;">
   <div class="container">
      <h1>{{ $title }}</h1>
   </div>
</section>
<!--Inner Header End--> 
<!--About Start-->
<section class="wf100 about">
   <!--About Txt Video Start-->
   <div class="about-video-section wf100">
      <div class="container">
         <div class="row">
            <div class="col-lg-7">
               <div class="about-text">
                  <h2>{{ $site_config->nama_singkat_kontraktor }}</h2>
                  <?php echo $site_config->tentang_kontraktor ?>
               </div>
               <a href="{{ asset('search2/done') }}" class="btn btn-outline-success btn-lg">Proyek Rampung</a> 
                           <a href="{{ asset('search2/in_progress') }}" class="btn btn-outline-primary btn-lg">Proyek Dalam Pengerjaan</a> 
            </div>
            <div class="col-lg-5">
               <a href="#"><img src="{{ asset('assets/upload/image/'.$site_config->gambar_kontraktor) }}" alt="{{ $site_config->nama_singkat }}" class="img img-fluid img-thumbnail"></a>
            </div>
         </div>
      </div>
   </div>
   <!--About Txt Video End--> 
</section>
<!--Service Area Start-->
 <section class="about wf100 p80">
   <div class="container text-center">
      <p><br><br></p>
      <!-- <h3>Layanan {{ website('namaweb') }}</h3> -->
      <hr>
      <div class="row">
         <?php foreach($layanan as $layanan) { ?>
            <div class="col-md-4 col-sm-6">
               <div class="volbox">
                  <img src="{{ asset('assets/upload/image/thumbs/'.$layanan->gambar) }}" alt="{{ $layanan->judul_berita }}" class="img img-thumbnail img-fluid">
                  <h6>{{ $layanan->judul_berita }}</h6>
                  <p>{{ $layanan->keywords }}</p>
                  <a href="{{ $layanan->link_berita }}">Lihat detail</a> 
               </div>
            </div>
         <?php } ?>
      </div>
   </div>
</div>
<br><br>
</section>
<div class="clearfix"><br><br></div>
