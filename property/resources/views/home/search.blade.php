<?php 
$bg   = DB::table('heading')->where('halaman','Search')->orderBy('id_heading','DESC')->first();
?>
<!--Inner Header Start-->
<section class="wf100 p80 inner-header" style="background-image: url('{{ asset('assets/upload/image/'.$bg->gambar) }}'); background-position: bottom center;">
</section>
<!--Inner Header End--> 
         <!--Service Area Start-->
         <section class="donation-join wf100">
            <div class="container text-center">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="" style="width:75%;margin:auto;">
                        <form method="GET" action="{{ asset('search/jual') }}" accept-charset="UTF-8" id="mainSearch">
                           <input id="order" name="order" type="hidden" value="newest">
                           <input id="limit" name="limit" type="hidden" value="{{ $limit }}">
                           <div class="p-2">
                              <div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-bottom:5px;"> 
                                 <label class="btn btn-home" for="buy">
                                    <input type="radio" class="btn-check" name="listing_type" id="buy" value="1" autocomplete="off" {{ (($listing_type=='1') ? 'checked' : '') }} />Jual
                                 </label>
                                 <label class="btn btn-home" for="rent">
                                    <input type="radio" class="btn-check" name="listing_type" id="rent" value="2" autocomplete="off" {{ (($listing_type=='2') ? 'checked' : '') }} />Sewa
                                 </label>
                              </div>
                              <input id="location" name="location" class="form-control py-2" type="text" placeholder="Search Properti" aria-label="Search Properti" value="{{ $location }}">
                              <div class="d-flex justify-content-between py-2">
                                 <button type="button" class="btn btn-home" data-toggle="collapse"
                                       data-target="#collapseExample" aria-expanded="false"
                                       aria-controls="collapseExample">
                                       Filter <i class="fas fa-sliders-h" aria-hidden="true"></i>
                                 </button>
                                 <button type="submit" class="btn btn-success">Search</button>
                              </div>
                              <div class="collapse" id="collapseExample">
                                 <div class="card card-body overflow-auto" style="max-height: 250px;">
                                    <div class="row">
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                                             </div>
                                             <select name="id_kategori_property" id="id_kategori_property" class="form-control select2">
                                                <option value="">Type</option>
                                                <?php foreach($kategori_property as $kategori_property) { ?>
                                                <option value="{{ $kategori_property->id_kategori_property }}" {{ (($id_kategori_property==$kategori_property->id_kategori_property) ? 'selected' : '') }}>{{ $kategori_property->nama_kategori_property }}</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                                             </div>
                                             <select name="certificates" id="certificates" class="form-control select2">
                                                <option value="">Certificates</option>
                                                <?php foreach($certificatesArray as $key => $cert) { ?>
                                                <option value="{{ $key }}" {{ (($key==$certificates) ? 'selected' : '') }}>{{ $cert }}</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                             </div>
                                             <select class="form-control" id="price_from" name="price_from">
                                                <option selected="selected" value="">Min Price</option>
                                                <?php foreach($priceArray as $key=>$val) { ?>
                                                   <option value="{{ $val }}" {{ (($price_from==$val) ? 'selected' : '') }}>{{ number_format($val) }}</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                             </div>
                                             <select class="form-control" id="price_to" name="price_to">
                                                <option selected="selected" value="">Max Price</option>
                                                <?php foreach($priceArray as $key=>$val) { ?>
                                                   <option value="{{ $val }}" {{ (($price_to==$val) ? 'selected' : '') }}>{{ number_format($val) }}</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-bed"></i></span>
                                             </div>
                                             <select class="form-control" id="bedrooms" name="bedrooms">
                                                <option selected="selected" value="">Bedroom</option>
                                                <?php foreach($bedroomArray as $key=>$val) { ?>
                                                   <option value="{{ $val }}" {{ (($bedrooms==$val) ? 'selected' : '') }}>{{ number_format($val) }}</option>
                                                <?php } ?>
                                                <option value="5+" {{ (($bedrooms=='5+') ? 'selected' : '') }}>5+</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-bath"></i></span>
                                             </div>
                                             <select class="form-control" id="bathrooms" name="bathrooms"><option selected="selected" value="">Bathroom</option>
                                                <?php foreach($bathroomsArray as $key=>$val) { ?>
                                                   <option value="{{ $val }}" {{ (($bathrooms==$val) ? 'selected' : '') }}>{{ number_format($val) }}</option>
                                                <?php } ?>
                                                <option value="7+" {{ (($bathrooms=='7+') ? 'selected' : '') }}>7+</option>
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text">LT</span>
                                             </div>
                                             <input class="form-control" id="landsize_from" placeholder="Min Land Area (m²)" name="landsize_from" type="text" value="{{ $landsize_from }}">	
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text">LT</span>
                                             </div>
                                             <input class="form-control" id="landsize_to" placeholder="Max Land Area (m²)" name="landsize_to" type="text" value="{{ $landsize_to }}">
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text">LB</span>
                                             </div>
                                             <input class="form-control" id="buildingsize_from" placeholder="Min Bld/Fl Area (m²)" name="buildingsize_from" type="text" value="{{ $buildingsize_from }}">
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-12">
                                          <div class="input-group mb-3">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text">LB</span>
                                             </div>
                                             <input class="form-control" id="buildingsize_to" placeholder="Max Bld/Fl Area (m²)" name="buildingsize_to" type="text" value="{{ $buildingsize_to }}">
                                          </div>
                                       </div>
                                       <div class="col-lg-12 col-sm-12">
                                          <div class="d-grid">
                                             <button id="applyFilter" type="submit" class="btn btn-success">Apply Filter</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>


                        <script>
                        $(function() {    

                           $('#mainSearch').submit(function(e) {

                              let listing_type = $('input[name="listing_type"]:checked').val();
                              let action = base_url + "search/jual";
                        
                              if(listing_type == 2){
                                 action = base_url + "search/sewa";
                              }

                              //$(this).attr('action',action);

                              var values = {};
                              if($("#id_kategori_property").val() != ""){
                                 values["id_kategori_property"] = $("#id_kategori_property").val();
                              }
                              if($("#location").val() != ""){
                                 values["location"] = $("#location").val();
                              }
                              if($("#certificates").val() != ""){
                                 values["certificates"] = $("#certificates").val();
                              }

                              if($("#price_from").val() != ""){
                                 values["price_from"] = $("#price_from").val();
                              }
                              if($("#price_to").val() != ""){
                                 values["price_to"] = $("#price_to").val();
                              }
                              if($("#bedrooms").val() != ""){
                                 values["bedrooms"] = $("#bedrooms").val();
                              }
                              if($("#bathrooms").val() != ""){
                                 values["bathrooms"] = $("#bathrooms").val();
                              }
                              if($("#landsize_from").val() != ""){
                                 values["landsize_from"] = $("#landsize_from").val();
                              }
                              if($("#landsize_to").val() != ""){
                                 values["landsize_to"] = $("#landsize_to").val();
                              }
                              if($("#buildingsize_from").val() != ""){
                                 values["buildingsize_from"] = $("#buildingsize_from").val();
                              }
                              if($("#buildingsize_to").val() != ""){
                                 values["buildingsize_to"] = $("#buildingsize_to").val();
                              }
                              if($("#order").val() != ""){
                                 values["order"] = $("#order").val();
                              }
                              if($("#limit").val() != ""){
                                 values["limit"] = $("#limit").val();
                              }
                              const params = new URLSearchParams(values);								
                              window.location.href = action + "?" + params.toString();
                              e.preventDefault();

                              //$(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
                              //return true;
                           });

                           var xhr;
                           $('#location').autoComplete({
                              minChars: 1,
                              source: function(term, response){	
                                 try { xhr.abort(); } catch(e){}
                                 xhr = $.getJSON(base_url + 'listing/location', {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'), q: term }, function(data){ 
                                    response(data);			
                                 });
                              },
                              renderItem: function (item, search){
                                 search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                                 var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                                 return '<div class="autocomplete-suggestion" data-district="' + item[0] + '" data-city="' + item[0] + '" data-province="' + item[1] + '" data-val="' + search + '">' + item[0].replace(re, "<b>$1</b>") + ' <span style="color:#999;font-size:13px;">' + item[1] + ', </span> ' + '</span></div>';
                              },
                              
                              onSelect: function(e, term, item){
                              
                                 $('#location').val(item.data('city') + ', ' + item.data('province'));
                              }
                           });

                           $('#selectLimit').on('change', function (e){
                              $('#limit').val($(this).val());
                              $('#mainSearch').submit();
                           });

                           $('#selectOrder').on('change', function (e){
                              $('#order').val($(this).val());
                              $('#mainSearch').submit();
                           });

                        });
                           
                        </script>

                     </div>
                  </div>
               </div>
            </div>
         </section>

         <section class="about wf100" style="margin-top:50px;">
            <div class="container px-4 px-lg-5">
               <div class="row">
                  <div class="col-sm-12" style="padding:0px;">
                     <h1 style="font-size:28px;">{{ (($listing_type=='1') ? 'Dijual' : 'Disewakan') }} Property {{ (($location!='') ? 'di '.$location : '') }}</h1>
                  </div>
                  <div class="col-sm-8" style="padding:0px;">
                
                  </div>
                  <div class="col-sm-4">
                     <div class="input-group">
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
                        if($property->status == '0') {
                           $statusName = '';
                           $displayStatus = 'display:none;';
                        } else {
                           $statusName = 'Ter'.$property->tipe;
                           $displayStatus = '';
                        }
                  ?>
                  <div class="col-sm-12 col-md-4 col-lg-4 p-2">
                     <div class="card">
                        <a href="{{ asset('properti')."/".$property->id_property."/".$property->slug_property }}" title="{{ $property->nama_property }}">
                           <div class="zoom">
                              <img src="{{ asset('assets/upload/property/'.$image->gambar) }}" class="card-img-top" alt="{{ $property->nama_property }}" onerror="this.onerror=null;">
                           </div>
                           <span class="top-left-badge" id="badgelisting" style="background-color: hsla(0, 0%, 100%, 0.65);">{{ $labelType }}</span>
                           <span class="top-left-badge-2" id="badgelisting" style="background-color: hsla(0, 0%, 100%, 0.65);{{ $displayStatus }}">{{ $statusName }}</span>
                           <div class="card-body d-flex flex-column" style="height: 200px;">
                              <div class="text-truncate-container">
                                 <p class="font-weight-bold" style="font-size: 1.1rem;margin:0;">{{ $property->nama_property }} <span style="color:red;{{ $displayStatus }}">({{ $statusName }})<span></p>
                              </div>
                              <p class="card-text font-italic" style="margin:0;"> {{ ucwords(strtolower($property->nama_kabupaten.', '.$property->nama_provinsi)) }}</p>
                              <ul class="list-inline" style="margin:0;">
                                 <li class="list-inline-item"><i class="fas fa-bed"></i> {{ $property->kamar_tidur }}</li>
                                 <li class="list-inline-item"><i class="fas fa-bath"></i> {{ $property->kamar_mandi }}</li>
                                 <li class="list-inline-item"><i class="fas fa-expand"></i> {{ $property->lt }} m<sup>2</sup></li>
                                 <li class="list-inline-item"><i class="fas fa-building"></i> {{ $property->lb }} m<sup>2</sup></li>
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
         <!--Service Area End--> 
         
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

