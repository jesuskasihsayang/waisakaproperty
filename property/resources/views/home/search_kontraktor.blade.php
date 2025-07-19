<?php 
$bg   = DB::table('heading')->where('halaman','Search')->orderBy('id_heading','DESC')->first();
?>
<!--Inner Header Start-->
<section class="wf100 p80 inner-header" style="background-image: url('{{ asset('assets/upload/image/'.$bg->gambar) }}'); background-position: bottom center;">
</section>
<!--Inner Header End--> 

         <section class="about wf100" style="margin-top:50px;">
            <div class="container px-4 px-lg-5">
               <div class="row">
                  <div class="col-sm-12" style="padding:0px;">
                     <h1 style="font-size:28px;">Proyek Yang {{ (($listing_type=='1') ? 'Sudah Dikerjakan' : 'Sedang Dikerjakan') }} {{ (($location!='') ? 'di '.$location : '') }}</h1>
                  </div>
                  <div class="col-sm-8" style="padding:0px;">
                
                  </div>
                  <div class="col-sm-4">
                     <div class="input-group">
                        <form method="GET" action="{{ asset('search2/done') }}" accept-charset="UTF-8" id="mainSearch">
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
                        </select>
                     </div>
                  </div>
               </div>

               <script>
                  $(function() {    

                     $('#mainSearch').submit(function(e) {

                        let action = base_url + "{{ (($listing_type == '1') ? 'search2/done' : 'search2/in_progress') }}";

                        //$(this).attr('action',action);

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

               <div class="row gx-4 gx-lg-5">
                  <?php
                     foreach($projects as $proyek) { 
                        $image = DB::table('proyek_img')->where('id_proyek',$proyek->id_proyek)->orderBy('id_proyek_img')->first();
                        $labelType = ($proyek->tipe == 'done') ? 'Done' : 'In Progress';
                  ?>
                  <div class="col-sm-12 col-md-4 col-lg-4 p-2">
                     <div class="card">
                        <a href="{{ asset('proyek')."/".$proyek->id_proyek."/".$proyek->slug_proyek }}" title="{{ $proyek->nama_proyek }}">
                           <div class="zoom">
                              <img src="{{ asset('assets/upload/proyek/'.$image->gambar) }}" class="card-img-top" alt="{{ $proyek->nama_proyek }}" onerror="this.onerror=null;">
                           </div>
                           <span class="top-left-badge" id="badgelisting" style="background-color: hsla(0, 0%, 100%, 0.65);">{{ $labelType }}</span>
                           <div class="card-body d-flex flex-column" style="height: 120px;">
                              <div class="text-truncate-container">
                                 <p class="font-weight-bold" style="font-size: 1.1rem;margin:0;">{{ $proyek->nama_proyek }} </p>
                              </div>
                              <p class="card-text font-italic" style="margin:0;"> {{ ucwords(strtolower($proyek->nama_kabupaten.', '.$proyek->nama_provinsi)) }}</p>
                              <ul class="list-inline" style="margin:0;">
                                 <li class="list-inline-item"><i class="fas fa-expand"></i> {{ $proyek->lt }}</li>
                                 <li class="list-inline-item"><i class="fas fa-building"></i> {{ $proyek->lb }}</li>
                              </ul>
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
                     Showing {{ $projects->currentPage() }} - {{ $projects->perPage() }} of {{ $projects->total() }} result
                  </div>
                  <div class="col-lg-7 col-sm-12 col-md-12 py-2">
                     <nav>
                        <ul class="pagination">
                           @if($projects->currentPage() > 1)
                           <li class="page-item" aria-disabled="true">
                              <a class="page-link" href="{{ $projects->appends(request()->query())->previousPageUrl() }}">&laquo; Previous</a>
                           </li>
                           @else
                           <li class="page-item disabled" aria-disabled="true">
                              <span class="page-link">&laquo; Previous</span>
                           </li>
                           @endif
                           
                           @if($projects->hasMorePages())
                           <li class="page-item" aria-disabled="true">
                              <a class="page-link" href="{{ $projects->appends(request()->query())->nextPageUrl() }}">Next &raquo;</a>
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

