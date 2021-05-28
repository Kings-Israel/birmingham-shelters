<x-admin-layout :pageTitle="$listing->name">
    <x-breadcrumb :items="$breadcrumb" />

    <!-- ============================ Property Header Info Start================================== -->
    <div class="bg-title">
        <div class="container px-4 py-3">
            <h3 class="text-light">{{ $listing->name }}</h3>
        </div>
    </div>
    <!-- ============================ Property Header Info Start================================== -->

    <!-- ============================ Property Detail Start ================================== -->
    <section class="gray-simple">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

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

                        <div id="clSev" class="panel-collapse collapse" aria-expanded="true">
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

                    <!-- Documents Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#loca" data-bs-target="#clSix" aria-controls="clSix"
                                href="javascript:void(0);" aria-expanded="true" class="collapsed">
                                <h4 class="property_block_title">Related Documents</h4>
                            </a>
                        </div>

                        <div id="clSix" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <h4>TODO: list documents</h4>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Property Detail End ================================== -->

</x-admin-layout>
