<x-app-layout pageTitle="Landlord">
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <section class="bg-light">
        <div class="container-fluid">
                        
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="filter_search_opt">
                        <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i class="ml-2 ti-menu"></i></a>
                    </div>
                </div>
            </div>
                        
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    @include('partials.landlord-sidenav')
                </div>
                <div class="col-lg-9 col-md-12">
                <!-- ============================ Property Header Info Start================================== -->
                <section class="bg-title">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-11 col-md-12">
                        
                                <div class="property_block_wrap style-4">
                                    <div class="prt-detail-title-desc">
                                        <h3 class="text-light">{{ $listing->name }}</h3>
                                        <span><i class="lni-map-marker"></i> {{ $listing->address }}, {{ $listing->local_authority_area }}</span>
                                        <p class="prt-price-fix">Postcode: <strong>{{ $listing->postcode }}</strong></p>
                                    </div>
                                    <p style="margin-bottom: 0;">
                                        Status: 
                                        @if ($listing->is_verified == '')
                                            <strong> Not Verified </strong>
                                        @else
                                            <strong>Verified</strong>
                                        @endif
                                    </p>
                                </div>
                                
                            </div>	
                        </div>
                    </div>
                </section>
                <!-- ============================ Property Header Info Start================================== -->

                <!-- ============================ Property Detail Start ================================== -->
			    <section class="gray-simple">
				<div class="container">
						
						    <!-- property main detail -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne" href="javascript:void(0);" aria-expanded="false"><h4 class="property_block_title">Detail & Features</h4></a>
                        </div>
                        <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne" aria-expanded="true">
                            <div class="block-body">
                                <ul class="deatil_features">
                                    <li><strong>Living Rooms:</strong>{{ $listing->living_rooms }}</li>
                                    <li><strong>Bedsitting Rooms:</strong>{{ $listing->bedsitting_rooms }}</li>
                                    <li><strong>Bedrooms:</strong>{{ $listing->bedrooms }}</li>
                                    <li><strong>Bathrooms:</strong>{{ $listing->bathrooms }}</li>
                                    <li><strong>Toilets:</strong>{{ $listing->toilets }}</li>
                                    <li><strong>Kitchen:</strong>{{ $listing->kitchen }}</li>
                                    
                                    {{-- <li><strong>Status:</strong>Active</li> --}}
                                    
                                </ul>
                                @if ($listing->other_rooms)
                                    <h6 class="property_block_title">Other Rooms:</h6>
                                    <p>{{ $listing->other_rooms }}</p>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Description</h4></a>
                        </div>
                        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <p>{{ $listing->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#amen"  data-bs-target="#clThree" aria-controls="clThree" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Client Groups</h4></a>
                        </div>
                        
                        <div id="clThree" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <ul class="avl-features third color">
                                    @foreach ($client_group->client_group as $client)
                                        <li>{{ $client }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#loca"  data-bs-target="#clSix" aria-controls="clSix" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Location</h4></a>
                        </div>
                        
                        <div id="clSix" class="panel-collapse collapse" aria-expanded="true">
                            <div class="block-body">
                                <div class="map-container">
                                    <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781" data-mapTitle="Our Location"></div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#clSev"  data-bs-target="#clSev" aria-controls="clOne" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Gallery</h4></a>
                        </div>
                        
                        <div id="clSev" class="panel-collapse collapse" aria-expanded="true">
                            <div class="block-body">
                                <ul class="list-gallery-inline">
                                    @foreach ($listing_images as $image)
                                        <li>
                                            <a href="{{ asset('/storage/listing/images/'.$image->image_name) }}" class="mfp-gallery"><img src="{{ asset('/storage/listing/images/'.$image->image_name) }}" class="img-fluid mx-auto" alt="" /></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#nearby" data-bs-target="#clNine" aria-controls="clNine" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Nearby</h4></a>
                        </div>
                        
                        <div id="clNine" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                
                                <!-- Schools -->
                                <div class="nearby-wrap">
                                    <div class="nearby_header">
                                        <div class="nearby_header_first">
                                            <h5>Schools Around</h5>
                                        </div>
                                        <div class="nearby_header_last">
                                            <div class="nearby_powerd">
                                                Powerd by <img src="assets/img/edu.png" class="img-fluid" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="neary_section_list">
                                    
                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Green Iseland School<small>(3.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>														
                                                </div>
                                                <small class="reviews-count">(421 Reviews)</small>
                                            </div>
                                        </div>
                                        
                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Ragni Intermediate College<small>(0.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star-half filled"></i>														
                                                </div>
                                                <small class="reviews-count">(470 Reviews)</small>
                                            </div>
                                        </div>
                                        
                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Rose Wood Primary Scool<small>(0.47 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>														
                                                </div>
                                                <small class="reviews-count">(204 Reviews)</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- Hotel & Restaurant -->
                                <div class="nearby-wrap">
                                    <div class="nearby_header">
                                        <div class="nearby_header_first">
                                            <h5>Food Around</h5>
                                        </div>
                                        <div class="nearby_header_last">
                                            <div class="nearby_powerd">
                                                Powerd by <img src="assets/img/food.png" class="img-fluid" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="neary_section_list">
                                    
                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">The Rise hotel<small>(2.42 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>														
                                                </div>
                                                <small class="reviews-count">(105 Reviews)</small>
                                            </div>
                                        </div>
                                        
                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Blue Ocean Bar & Restaurant<small>(1.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>														
                                                </div>
                                                <small class="reviews-count">(40 Reviews)</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</section>
			<!-- ============================ Property Detail End ================================== -->
            </div>
            </div>
        </div>
    </section>

</x-app-layout>