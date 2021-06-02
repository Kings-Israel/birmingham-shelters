<x-app-dashboard-layout :pageTitle="$listing->name">
    <!-- ============================ Property Header Info Start================================== -->
    <section class="bg-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">

                    <div class="property_block_wrap style-4">
                        <div class="prt-detail-title-desc">
                            <h3 class="text-light">{{ $listing->name }}</h3>
                            <span><i class="lni-map-marker"></i> {{ $listing->address }},
                                {{ $listing->local_authority_area }}</span>
                            <p class="prt-price-fix">Postcode: <strong>{{ $listing->postcode }}</strong>
                            </p>
                        </div>
                        <p style="margin-bottom: 0;">
                            Status:
                            @if ($listing->verified_at == null)
                            <strong class="text-success">Verified</strong>
                            @else
                            <strong class="text-warning"> Not Verified </strong>
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
                    <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne"
                        href="javascript:void(0);" aria-expanded="false">
                        <h4 class="property_block_title">Detail & Features</h4>
                    </a>
                </div>
                <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne" aria-expanded="true">
                    <div class="block-body">
                        <ul class="deatil_features">
                            <li><strong>Living Rooms:</strong>{{ $listing->living_rooms }}</li>
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

            <!-- Description Single Block Wrap -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                        href="javascript:void(0);" aria-expanded="true">
                        <h4 class="property_block_title">Description</h4>
                    </a>
                </div>
                <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                    <div class="block-body">
                        <p>{{ $listing->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Supported Client Groups Single Block Wrap -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#amen" data-bs-target="#clThree" aria-controls="clThree"
                        href="javascript:void(0);" aria-expanded="true">
                        <h4 class="property_block_title">Client Groups</h4>
                    </a>
                </div>

                <div id="clThree" class="panel-collapse collapse show" aria-expanded="true">
                    <div class="block-body">
                        <ul class="avl-features third color">
                            @foreach ($listing->clientgroup->client_group_list as $client)
                            <li class="text-capitalize">{{ $client }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="block-body">
                        <h6 class="property_block_title">Client Support Description:</h6>
                        <p>{{ $listing->clientgroup->support_description }}</p>
                    </div>

                    <div class="block-body">
                        <p class="property_block_title"><strong>Client Support Hours per week:</strong> {{ $listing->clientgroup->support_hours }}</h6>
                    </div>
                </div>
            </div>

            <!-- Location Single Block Wrap -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#loca" data-bs-target="#clSix" aria-controls="clSix"
                        href="javascript:void(0);" aria-expanded="true" class="collapsed">
                        <h4 class="property_block_title">Location</h4>
                    </a>
                </div>

                <div id="clSix" class="panel-collapse collapse" aria-expanded="true">
                    <div class="block-body">
                        <div class="map-container">
                            <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"
                                data-mapTitle="Our Location"></div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Gallery Single Block Wrap -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#clSev" data-bs-target="#clSev" aria-controls="clOne"
                        href="javascript:void(0);" aria-expanded="true" class="collapsed">
                        <h4 class="property_block_title">Gallery</h4>
                    </a>
                </div>

                <div id="clSev" class="panel-collapse collapse show" aria-expanded="true">
                    <div class="block-body">
                        <ul class="list-gallery-inline">
                            @foreach ($listing->listingimage as $image)
                            <li>
                                <a href="{!! $image->url() !!}" class="mfp-gallery"><img src="{!! $image->url() !!}"
                                        class="img-fluid mx-auto" alt="" /></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Nearby Single Block Wrap -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#nearby" data-bs-target="#clNine" aria-controls="clNine"
                        href="javascript:void(0);" aria-expanded="true">
                        <h4 class="property_block_title">Nearby</h4>
                    </a>
                </div>

                <div id="clNine" class="panel-collapse collapse" aria-expanded="true">
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
                                        <h4 class="nearby_place_title">Green Iseland School<small>(3.52
                                                mi)</small></h4>
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
                                        <h4 class="nearby_place_title">Ragni Intermediate
                                            College<small>(0.52 mi)</small></h4>
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
                                        <h4 class="nearby_place_title">Rose Wood Primary
                                            Scool<small>(0.47 mi)</small></h4>
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
                                        <h4 class="nearby_place_title">The Rise hotel<small>(2.42
                                                mi)</small></h4>
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
                                        <h4 class="nearby_place_title">Blue Ocean Bar &
                                            Restaurant<small>(1.52 mi)</small></h4>
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

</x-app-dashboard-layout>
