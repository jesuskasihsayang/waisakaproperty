<?php 
$bg   = DB::table('heading')->where('halaman','Search')->orderBy('id_heading','DESC')->first();
?>
<!--Inner Header Start-->
	<section class="wf100 p80 inner-header" style="background-image: url('{{ asset('assets/upload/image/'.$bg->gambar) }}'); background-position: bottom center;">
	</section>
	<section class="donation-join wf100">

		<div class="container" style="padding-top:15px;padding-bottom:15px">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="about-avatar">
						<img class="img-fluid" src="{{ ($staff->gambar!="") ? asset('assets/upload/staff/thumbs/'.$staff->gambar) : asset('assets/aws/images/no-profile.png') }}" height="500px" width="width:500px;"
							title="{{ $staff->nama_staff }}" alt="{{ $staff->nama_staff }}">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-text go-to">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<h1 class="dark-color">{{ $staff->nama_staff }}</h1>
								<p class="fw-light fst-italic"><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;{{ $staff->nama_kabupaten.', '.$staff->nama_provinsi }}
								</p>
							</div>
						</div>

						<?php
							// Should use UTF8 for Whatsapp
							$msg		= "Hello ".$staff->nama_staff;
							$msg        = utf8_encode($msg);
							// Whatsapp patterns
							$nl         = "%0D%0A"; // newline
							$space      = "%20";    // space
							// Replace some Whatstapp tags 
							$msg        =  str_replace( array("<b>","<bold>","</b>","</bold>"), array("*","*","*","*"), $msg);
							// Replace newline to Whatsapp format
							$msg        =  str_replace( array(" ","<br>","\n", "\r\n"), array($space,$nl,$nl,$nl), $msg);
						?>

						<blockquote class="blockquote">
							<p></p>
						</blockquote>
						<div class="row">
							<div class="col-sm-12 col-md-4 col-lg-4">
								<div class="d-grid gap-2 py-2">
									<a href="tel:{{ substr_replace($staff->telepon, '62', 0, 1) }}" class="btn btn-outline-rw btn-block" type="button"><i class="fas fa-phone fa-lg"></i></a>
								</div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<div class="d-grid gap-2 py-2">
									<a href="mailto:{{ $staff->email }}"  class="btn btn-outline-dark btn-block" role="button" style="background-color: #fff;color:#000;"><i class="fas fa-envelope fa-lg"></i></a>
								</div>
							</div>
							<div class="col-sm-12 col-md-4 col-lg-4">
								<div class="d-grid gap-2 py-2">
									<a target="_blank" href="https://wa.me/{{ substr_replace($staff->telepon, '62', 0, 1) }}?text={{ $msg }}" class="btn btn-wa btn-block" type="button" style="background-color: #fff;color:#000;"><i class="fab fa-whatsapp fa-lg"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>

	<section class="about wf100" style="margin-top:50px;">
		<div class="container px-4 px-lg-5">
			<div class="row">
				<div class="col-sm-12" style="padding:0px;">
				<h2 class="text-center">{{ $staff->nickname_staff }} Listings</h2>
				<hr style="color: #FBE60F;  height: 6px; width: 30%; margin: auto; margin-bottom: 20px;" class="text-center">
				</div>
				<div class="col-sm-8" style="padding:0px;">
			
				</div>
				<div class="col-sm-4">
					<div class="input-group">
						<form method="GET" action="{{ asset('search/agent'.$staff->id_staff) }}" accept-charset="UTF-8" id="resultSearch">
							<input id="order" name="order" type="hidden" value="newest">
							<input id="limit" name="limit" type="hidden" value="{{ $limit }}">
						</form>
						<select class="form-control" id="selectLimit" name="selectLimit">
							<option value="6" <?php echo (($limit=='6') ? 'selected' : '') ?>>6</option>
							<option value="9" <?php echo (($limit=='9') ? 'selected' : '') ?>>9</option>
							<option value="15" <?php echo (($limit=='15') ? 'selected' : '') ?>>15</option>
							<option value="30" <?php echo (($limit=='30') ? 'selected' : '') ?>>30</option>
							<option value="39"> <?php echo (($limit=='39') ? 'selected' : '') ?>39</option>
						</select>
						<select class="form-control" id="selectOrder" name="selectOrder">
							<option value="newest" <?php echo (($order=='newest') ? 'selected' : '') ?>>Newest</option>
							<option value="price_desc" <?php echo (($order=='price_desc') ? 'selected' : '') ?>>Highest Price</option>
							<option value="price_asc"<?php echo (($order=='price_asc') ? 'selected' : '') ?>>Lowest Price</option>
						</select>
					
					</div>
				</div>
			</div>
			<div class="row gx-4 gx-lg-5">
				<?php
					foreach($properties as $property) { 
					$image = DB::table('property_img')->where('id_property',$property->id_property)->orderBy('id_property_img')->first();
					$labelType = ($property->tipe == 'jual') ? 'For Sell' : 'For Rent';
				?>
				<div class="col-sm-12 col-md-4 col-lg-4 p-2">
					<div class="card">
					<a href="{{ asset('properti')."/".$property->id_property."/".$property->slug_property }}" title="{{ $property->nama_property }}">
						<div class="zoom">
							<img src="{{ asset('assets/upload/property/'.$image->gambar) }}" class="card-img-top" alt="{{ $property->nama_property }}" onerror="this.onerror=null;">
						</div>
						<span class="top-left-badge" id="badgelisting" style="background-color: hsla(0, 0%, 100%, 0.65);">{{ $labelType }}</span>
						<div class="card-body d-flex flex-column" style="height: 200px;">
							<div class="text-truncate-container">
								<p class="font-weight-bold" style="font-size: 1.1rem;margin:0;">{{ $property->nama_property }} </p>
							</div>
							<p class="card-text font-italic" style="margin:0;"> {{ ucwords(strtolower($property->nama_kabupaten.', '.$property->nama_provinsi)) }}</p>
							<ul class="list-inline" style="margin:0;">
								<li class="list-inline-item"><i class="fas fa-bed"></i> {{ $property->kamar_tidur }}</li>
								<li class="list-inline-item"><i class="fas fa-bath"></i> {{ $property->kamar_mandi }}</li>
							</ul>
							<div class=" bottom-0 end-0" style="position:absolute;bottom:0;right:0;margin-right:20px;">
								<p class="font-weight-bold text-align-right" style="font-size:20px;align-self:end;"> Rp. {{ number_format($property->harga) }}{{ (($property->tipe=='sewa') ? ' / '.ucwords($property->jenis_sewa) : '') }}</p>
							</div>
						</div>
					</a>
					</div>
				</div>
				<?php
					}
				?>
				</div>

			<div class="row gx-4 gx-lg-5">
				<div class="col-lg-5 col-sm-12 col-md-12 py-2">
					Showing {{ $properties->currentPage() }} - {{ $properties->perPage() }} of {{ $properties->total() }} result
				</div>
				<div class="col-lg-7 col-sm-12 col-md-12 py-2">
					<nav>
					<ul class="pagination">
						@if($properties->currentPage() > 1)
						<li class="page-item" aria-disabled="true">
							<a class="page-link" href="{{ $properties->appends(request()->query())->previousPageUrl() }}">&laquo; Previous</a>
						</li>
						@else
						<li class="page-item disabled" aria-disabled="true">
							<span class="page-link">&laquo; Previous</span>
						</li>
						@endif
						
						@if($properties->hasMorePages())
						<li class="page-item" aria-disabled="true">
							<a class="page-link" href="{{ $properties->appends(request()->query())->nextPageUrl() }}">Next &raquo;</a>
						</li>
						@else
						<li class="page-item disabled" aria-disabled="true">
							<span class="page-link">Next &raquo;</span>
						</li>
						@endif
					</ul>
					</nav>
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

			$('#resultSearch').submit(function(e) {

				action = base_url + "agent/{{ $staff->id_staff }}";
				var values = {};
				if($("#order").val() != ""){
					values["order"] = $("#order").val();
				}
				if($("#limit").val() != ""){
					values["limit"] = $("#limit").val();
				}
				const params = new URLSearchParams(values);								
				window.location.href = action + "?" + params.toString();
				e.preventDefault();
			})

			$('#selectLimit').on('change', function (e){
				$('#limit').val($(this).val());
				$('#resultSearch').submit();
			});

			$('#selectOrder').on('change', function (e){
				$('#order').val($(this).val());
				$('#resultSearch').submit();
			});

		})
	</script>

