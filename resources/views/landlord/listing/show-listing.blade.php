<x-app-dashboard-layout :pageTitle="$listing->name">
    <!-- ============================ Property Header Info Start================================== -->
    <section class="bg-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">

                    <div class="property_block_wrap style-4">
                        <div class="prt-detail-title-desc">
                            <h3 class="text-light" id="listing_name">{{ $listing->name }}</h3>
                            <p hidden id="listing_address">{{ $listing->address }}</p>
                            <p hidden id="listing_postcode">{{ $listing->postcode }}</p>
                            <span><i class="lni-map-marker"></i> {{ $listing->address }}, {{ $listing->postcode }}</span>
                        </div>
                        <p style="margin-bottom: 0;">
                            Status: {{ $listing->status->label }}
                        </p>

                        <a href="{{ route('listing.bookings.all', $listing->id) }}">
                            <button class="btn btn-theme-light-2 rounded mt-3" type="submit">View Bookings ({{ $listing->bookings_count }})</button>
                        </a>
                        <a href="{{ route('listing.inquiries.all', $listing->id) }}">
                            <button class="btn btn-theme-light-2 rounded mt-3" type="submit">View Inquiries ({{ $listing->inquiry_count }})</button>
                        </a>
                        @if ($listing->is_sponsored == NULL || $listing->is_sponsored < date('Y-m-d'))
                            <form action="{{ route('listing.sponsored') }}" method="post">
                                @csrf
                                <input type="hidden" name="listing" value="{{ $listing }}">
                                <button class="btn btn-theme-light-2 rounded mt-3" type="submit">Make Sponsored</button>
                            </form>
                        @else
                            <p>Sponsored upto {{ $listing->is_sponsored }}</p>
                        @endif
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
                        <h4 class="property_block_title">Details & Features</h4>
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
                            <li><strong>Available Rooms:</strong>{{ $listing->available_rooms }}</li>
                            <li><strong>Occupied Rooms:</strong>{{ $listing->occupied_rooms }}</li>
                        </ul>
                        @if ($listing->other_rooms != null)
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
                        @if ($listing->status->label != "Verified")
                            <button class="btn btn-md btn-theme-light-2 rounded" data-bs-toggle="modal" data-bs-target="#listing-features-update" style="float: right;">Update</button>
                            @include('partials.listing-features-update')
                        @endif
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
                            @foreach ($listing->supported_groups as $client)
                            <li class="text-capitalize">{{ $client }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="block-body">
                        <h6 class="property_block_title">Client Support Description:</h6>
                        <p>{{ $listing->support_description }}</p>
                    </div>

                    <div class="block-body">
                        <p class="property_block_title"><strong>Client Support Hours per week:</strong> {{ $listing->support_hours }}</p>
                        @if ($listing->status->label != "Verified")
                            <button class="btn btn-md btn-theme-light-2 rounded" data-bs-toggle="modal" data-bs-target="#listing-support-group-update" style="float: right;">Update</button>
                            @include('partials.listing-support-group-update')
                        @endif
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

                <div id="clSix" class="panel-collapse collapse show" aria-expanded="true">
                    <div class="block-body">
                        <div class="hm-map-container fw-map" id="map-container">
                            <div id="map"></div>
                        </div>
                        <div id="map-error" class="error-message">No Location data was provided.</div>
                        <p style="margin-top:5px; float: right;">*Note: Update the address and postcode to update location.</p>
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
                            @foreach ($listing->images as $image)
                            <li>
                                <a href="{!! $listing->getImageUrl($image) !!}" class="mfp-gallery"><img src="{!! $listing->getImageUrl($image) !!}"
                                        class="img-fluid mx-auto" alt="" /></a>
                            </li>
                            @endforeach
                        </ul>
                        @if(count($listing->images) > 0)
                        <a href="{{ route('listing.delete.images', $listing->id) }}">
                            <button class="btn btn-md btn-primary rounded" style="float: right; margin-left: 5px">Delete All Images</button>
                        </a>
                        @endif
                        <button class="btn btn-md btn-theme-light-2 rounded" data-bs-toggle="modal" data-bs-target="#listing-images-update" style="float: right;">Add</button>
                        @include('partials.listing-images-update')
                    </div>
                </div>
            </div>
            <div>
                @if ($listing->status != "Verified")
                    <button class="btn btn-md btn-theme-light-2 rounded" data-bs-toggle="modal" data-bs-target="#listing-documents-update" >Update Documents</button>
                    @include('partials.listing-documents-update')
                @endif
            </div>
            <hr>
            <!-- Feedback Messages -->
            <div class="property_block_wrap style-2">

                <div class="property_block_wrap_header">
                    <a data-bs-toggle="collapse" data-parent="#cl-feedback" data-bs-target="#cl-feedback"
                        aria-controls="cl-feedback" href="javascript:void(0);" aria-expanded="true"
                        class="collapsed">
                        <h4 class="property_block_title">Feedback</h4>
                    </a>
                </div>

                <div id="cl-feedback" class="panel-collapse collapse show" aria-expanded="true">
                    <div class="block-body">
                        <livewire:listing-feedback-list :listing="$listing" />
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Property Detail End ================================== -->
    @push('scripts')
        <script>
            function initMap() {
                var mapErrorContainer = document.getElementById('map-error');
                var address = document.getElementById('listing_address').innerText;
                var addressTitle = document.getElementById('listing_name').innerText;
                var addressPostalCode = document.getElementById('listing_postcode').innerText;
                var geocoder = new google.maps.Geocoder();

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
                });

                geocoder.geocode({
                    'address': address,
                    componentRestrictions : {
                        country: 'UK',
                        postalCode: addressPostalCode
                    }
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        mapErrorContainer.style.display = "none";
                        map.setCenter(results[0].geometry.location);
                        new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: addressTitle
                        });
                    } else {
                        const mapContainer = document.getElementById('map-container').style.display = "none";
                        // alert('Geocode was not successful for the following reasons: ' + status)
                    }
                })
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap" defer></script>
    @endpush
</x-app-dashboard-layout>
