<?php 
$bg   = DB::table('heading')->where('halaman','Search')->orderBy('id_heading','DESC')->first();
?>
<!--Inner Header Start-->
<section class="wf100 p80 inner-header" style="background-image: url('{{ asset('assets/upload/image/'.$bg->gambar) }}'); background-position: bottom center;">
</section>
         <!--Service Area Start-->
         <section class="donation-join wf100">
			<div class="container px-4 px-lg-5" style="padding-top:50px;">
				<div class="row flex-column-reverse flex-lg-row" data-aos="fade-up">
					<div class="col-sm-12 col-md-12 col-lg-4 order-sm-1">
						<div class="card text-center">
							<div class="card-body">
							<div class="d-none d-lg-block d-xl-block text-center py-3">
								<h5><span class="badge bg-gray">Project {{ (($proyek->tipe=='done') ? 'Has been Done' : 'is In Progress') }}</span></h5>
								<h1 style="font-weight: 400; font-size:28px;">{{ ucwords($proyek->nama_proyek) }}</h1>
								<h5 style="font-weight: 200;">{{ $proyek->nama_kabupaten.', '.$proyek->nama_provinsi }}</h5>
								<hr>
								<h6 style="font-weight: 200;">WORK DURATION</h6>
								<?php if($proyek->lama_pengerjaan > 0) { ?>
								<p class="h3 mb-3 text-center" id="price"> {{ number_format($proyek->lama_pengerjaan) }} Hari</p>
								<?php } else { ?>
								<p class="h3 mb-3 text-center" id="price"> - </p>
								<?php } ?>	
							</div>
							<div class="card text-start mb-3" style="visibility: hidden;">
								<div class="card-body">
									<h5 class="card-title text-left"><a href="{{ asset('agent')."/".$staff->id_staff }}"></a></h5>
									<div class="card-text mb-2 text-left"><a href="#"></a>
								</div>
							</div>
						</div>
						
					
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-8 order-sm-2">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
						<div id="mainCarousel" class="carousel w-10/12 max-w-5xl mx-auto">
							<?php foreach($images as $key => $img) { ?>
							<div class="carousel__slide" data-src="{{ asset('assets/upload/proyek/'.$img->gambar) }}" data-fancybox="gallery">
								<img src="{{ asset('assets/upload/proyek/'.$img->gambar) }}" alt="{{ $proyek->slug_proyek }}" class="img-fluid" onerror="this.onerror=null;" />
								<div class="top-right-badge d-flex flex-row" style="right:10px; background-color:transparent; ">
									<span style="background-color:hsla(0, 0%, 100%, 0.65);margin-right:10px;padding: 5px;">{{ (($proyek->tipe == 'done') ? 'Done' : 'In Progress') }}</span>
								</div>
							</div>
							<?php } ?>
						</div>

						<div id="thumbCarousel" class="carousel max-w-xl mx-auto">
							<?php foreach($images as $key => $img) { ?>	
							<div class="carousel__slide">
								<img class="panzoom__content" src="{{ asset('assets/upload/proyek/'.$img->gambar) }}" alt="apartment balehinggil pakuwn city rungkut surabaya timur" onerror="this.onerror=null;" />
							</div>
							<?php } ?>
						</div>
					</div>

					<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
						<div class="d-flex justify-content-center">
							<script async src="//www.instagram.com/embed.js"></script>
						</div>
					</div>
				</div>
				<nav>
					<div class="nav nav-tabs-agent justify-content-center" id="nav-tab" role="tablist">
					</div>
				</nav>
				<br>
				
				<div class="d-sm-block d-md-block d-lg-none text-center py-3">
					<h5><span class="badge bg-gray">Project {{ (($proyek->tipe=='done') ? 'Has been Done' : 'is In Progress') }}</span></h5>
					<h1 style="font-weight: 400; font-size:28px;">{{ ucwords($proyek->nama_proyek) }}</h1>
					<h5 style="font-weight: 200;">{{ $proyek->nama_kabupaten.', '.$proyek->nama_provinsi }}</h5>
					<hr>
					<h6 style="font-weight: 200;">WORK DURATION</h6>
					<?php if($proyek->lama_pengerjaan > 0) { ?>
					<p class="h3 mb-3 text-center" id="price"> {{ number_format($proyek->lama_pengerjaan) }} Hari</p>
					<?php } else { ?>
					<p class="h3 mb-3 text-center" id="price"> - </p>
					<?php } ?>	
				</div>
				
				<h2 style="font-size:28px;">
				Project {{ (($proyek->tipe=='done') ? 'Has been Done' : 'is In Progress') }} in {{ $proyek->nama_kabupaten.', '.$proyek->nama_provinsi }}
				</h2>
				{!! $proyek->isi !!}
				<hr>
				<h3>Specification</h3>
				<div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
							<tr>
								<td style="width: 25px;"><i class="fas fa-rectangle-list detail-icon"></i></td>
								<td style="width: 150px;">Listing Code </td>
								<td>: {{ $proyek->kode }}</td>
							</tr>
							<tr>
								<td style="width: 25px;"><i class="fas fa-building detail-icon"></i></td>
								<td style="width: 150px;">Building Size</td>
								<td>: {{ $proyek->lb }} m<sup>2</sup></td>
							</tr>
							<tr>
                                <td style="width: 25px;"><i class="fas fa-expand detail-icon"></i></td>
                                <td style="width: 150px;">Land Size </td>
                                 <td>:  {{ $proyek->lt }} m<sup>2</sup></td>
                            </tr>
						</tbody>
                    </table>
                </div>
				

					</div>
				</div>
			</div>
         </section>

         
         <!--Blog Start-->
         <section class="h2-news wf100 p80 blog">
            <div class="blog-grid">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="section-title-2">
                           <h5>Baca update kami</h5>
                           <h2>Berita & Updates</h2>
                        </div>
                     </div>
                     <div class="col-md-6"> <a href="{{ asset('berita') }}" class="view-more">Lihat berita lainnya</a> </div>
                     <div class="col-md-12">
                        <hr>
                     </div>
                  </div>
                  <div class="row" style="background-color: white; padding-top: 20px; padding-bottom: 20px; border-radius: 5px;">
                     <?php foreach($berita as $berita) { ?>
                     <!--Blog Small Post Start-->
                     <div class="col-md-4 col-sm-6" >
                        <div class="blog-post">
                           <div class="blog-thumb"> <a href="{{ asset('berita/read/'.$berita->slug_berita) }}"><i class="fas fa-link"></i></a> <img src="{{ asset('assets/upload/image/thumbs/'.$berita->gambar) }}" alt="><?php  echo $berita->judul_berita ?>"> </div>
                           <div class="post-txt">
                              <h5><a href="{{ asset('berita/read/'.$berita->slug_berita) }}"><?php  echo $berita->judul_berita ?></a></h5>
                              <ul class="post-meta">
                                 <li> <a href="{{ asset('berita/read/'.$berita->slug_berita) }}"><i class="fas fa-calendar-alt"></i> {{ tanggal('tanggal_id',$berita->tanggal_post)}}</a> </li>
                                 <li> <a href="{{ asset('berita/kategori/'.$berita->slug_berita) }}"><i class="fas fa-sitemap"></i> {{ $berita->nama_kategori }}</a> </li>
                              </ul>
                              <p><?php echo \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100, $end='...') ?></p>
                              <a href="{{ asset('berita/read/'.$berita->slug_berita) }}" class="read-post">Baca detail</a>
                           </div>
                        </div>
                     </div>
                     <!--Blog Small Post End--> 
                     <?php } ?>
                  </div>
                  
               </div>
            </div>
         </section>
         <!--Blog End--> 

		<script>
			$(function() {  

				// Initialise Carousel
				const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
					Dots: false,
				});

				// Thumbnails
				const thumbCarousel = new Carousel(document.querySelector("#thumbCarousel"), {
					Sync: {
						target: mainCarousel,
						friction: 0,
					},
					Dots: false,
					Navigation: false,
					center: true,
					slidesPerPage: 1,
					infinite: false,
				});

				// Customize Fancybox
				Fancybox.bind('[data-fancybox="gallery"]', {
					Carousel: {
						on: {
							change: (that) => {
								mainCarousel.slideTo(mainCarousel.findPageForSlide(that.page), {
									friction: 0,
								});
							},
						},
					},
				});

			})
		</script>

