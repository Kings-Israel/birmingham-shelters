<x-app-layout pageTitle="Listing">
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="featured_slick_gallery gray">
        <div class="featured_slick_gallery-slide">
            @foreach ($listing->images as $image)
                <div class="featured_slick_padd"><a href="{{ $listing->getImageUrl($image) }}" class="mfp-gallery"><img src="{{ $listing->getImageUrl($image) }}" class="img-fluid " alt="" /></a></div>
            @endforeach
        </div>
    </div>
    <section class="gray-simple rtl p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">

                    <div class="property_block_wrap style-3">

                        <div class="pbw-flex-1">
                            <div class="pbw-flex-thumb">
                                <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid" width="300" alt="" />
                            </div>
                        </div>

                        <div class="pbw-flex">
                            <div class="prt-detail-title-desc">
                                <div>
                                    <h3 id="listing_name">{{ $listing->name }}</h3>
                                    @if($listing->is_sponsored != null && $listing->is_sponsored > date('Y-m-d'))
                                        <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-4" style="float: right">Top</span>
                                    @endif
                                    @if ($listing->status->label == "Verified")
                                        <img src="{{ asset('/assets/img/star.png') }}" class="img-fluid" width="20px" style="float: right"/>
                                    @endif
                                </div>
                                <h6>Address: </h6><span id="listing_address">{{ $listing->address }}</span><br>
                                <h6>Postcode: </h6><span id="listing_postcode">{{ $listing->postcode }}</span>
                            </div>
                            <hr>
                            @guest
                                <p>Please login or sign up to join the waiting list for this room</p>
                            @endguest

                            @auth
                            @if ($listing->isBooked($listing->bookings))
                                <p>This listing has been fully occuppied</p>
                            @else
                                {{-- Check if user has filled referral form --}}
                                @if ((Auth::user()->isOfType('user')) && (Auth::user()->refereedata()->exists()))
                                    {{-- Check if user has been approved for another booking --}}
                                    @if (! Auth::user()->refereedata->first()->canBook(Auth::user(), Auth::user()->refereedata->first()->id, $listing->id))
                                        You have been approved for another listing.
                                    @else
                                        {{-- Check if user has already made a booking in this listing --}}
                                        @if ($listing->bookings->contains('user_id', Auth::user()->id))
                                            <p>You are in the waiting list for this room.</p>
                                        @else
                                            <form action="{{ route('listing.submit.booking') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="referee_data_id" value="{{ Auth::user()->refereedata()->first()->id }}">
                                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                                <button type="submit" class="btn btn-black btn-md rounded full-width">Join Waiting List</button>
                                            </form>
                                        @endif
                                    @endif
                                @elseif(Auth::user()->isOfType('agent'))
                                <button type="submit" class="btn btn-black btn-md rounded full-width" data-bs-toggle="modal" data-bs-target="#view_users">Add Referee To Waiting List</button>

                                <div wire:ignore class="modal fade" id="view_users" tabindex="-1" role="dialog" aria-labelledby="view_users_modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                        <div class="modal-content" id="view_users_modal">
                                            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                                            <div class="modal-body">
                                                <h4 class="modal-header-title">My Referees</h4>
                                                <p style="text-align: center">Select a referee to add to waiting list</p>
                                                <div class="login-form">
                                                    <livewire:referee-booking-list :listing="$listing" />
                                                    <h5 id="error-message" style="color: red; display: none">Please select a referee</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <p>Fill the Referral Form to Join the Waiting List for This Property</p>
                                @endif
                            @endif
                            @endauth
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne" href="javascript:void(0);" aria-expanded="false"><h4 class="property_block_title">Details</h4></a>
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
                                </ul>
                                <br>
                                @if ($listing->other_rooms != null)
                                    <h5 class="property_block_title">Other Rooms</h5>
                                    <ul class="deatil_features">
                                        {{ $listing->other_rooms }}
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne" href="javascript:void(0);" aria-expanded="false"><h4 class="property_block_title">Features</h4></a>
                        </div>
                        <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne" aria-expanded="true">
                            <div class="block-body">
                                <ul class="avl-features third color">
                                    @foreach ($listing->features as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
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
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Supported Client Groups</h4></a>
                        </div>
                        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <ul class="avl-features third clor">
                                    @foreach ($listing->supported_groups as $client)
                                        <li>{{ $client }}</li>
                                    @endforeach
                                </ul>
                                <hr>
                                <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                                    <h6>How the facility will offer support</h6>
                                    <div class="block-body">
                                        <p>{{ $listing->support_description }}</p>
                                    </div>
                                </div>
                                <h6>Support Hours: <strong>{{ $listing->support_hours }}</strong></h6>
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
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">

                    <div class="details-sidebar" id="listing-contact-form">

                        <!-- Agent Detail -->
                        <div class="sides-widget">
                            <div class="sides-widget-header">
                                <div class="sides-widget-details">
                                    <p>Listing Contact Details</p>
                                    <h4><a href="#">{{ $listing->contact_name }}</a></h4>
                                    <span><i class="lni-envelope"></i>{{ $listing->contact_email }}</span><br>
                                    <span><i class="lni-phone-handset"></i>{{ $listing->contact_number }}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <form action="{{ route('listing.inquiry') }}" method="post">
                                @csrf
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                @auth
                                    <input type="hidden" name="user_name" value="{{ Auth::user()->full_name }}">
                                    <input type="hidden" name="user_phone_number" value="{{ Auth::user()->phone_number }}">
                                    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                                @endauth

                                <div class="sides-widget-body simple-form">
                                    @guest
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Your Name" name="user_name" value="{{ old('user_name') }}">
                                            @error('user_name')
                                                <p class="error-message"><strong>{{ $message }}</strong></p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="Your Email" name="user_email" value="{{ old('user_email') }}">
                                            @error('user_email')
                                                <p class="error-message"><strong>{{ $message }}</strong></p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Phone No.</label>
                                            <input type="text" class="form-control" placeholder="Your Phone" name="user_phone_number" value="{{ old('user_phone_number') }}">
                                            @error('user_phone_number')
                                                <p class="error-message"><strong>{{ $message }}</strong></p>
                                            @enderror
                                        </div>
                                    @endguest
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="listing_message" class="form-control">{{ old('listing_message') }}</textarea>
                                        @error('listing_message')
                                            <p class="error-message"><strong>{{ $message }}</strong></p>
                                        @enderror
                                    </div>
                                    <button class="btn btn-black btn-md rounded full-width">Send Message</button>
                                </div>
                            </form>
                        </div>
                        @guest
                            <p>Please login or sign up to join the waiting list for this property</p>
                        @endguest
                        @auth
                            @if ($listing->isBooked($listing->bookings))
                                <p>This listing has been fully occuppied</p>
                            @else
                                @if ((Auth::user()->isOfType('user')) && (Auth::user()->refereedata()->exists()))
                                {{-- Check if user has been approved for another booking --}}
                                @if (! Auth::user()->refereedata->first()->canBook(Auth::user(), Auth::user()->refereedata->first()->id, $listing->id))
                                    You have been approved for another listing.
                                @else
                                    @if ($listing->bookings->contains('user_id', Auth::user()->id))
                                        <p>You are in the waiting list for this room.</p>
                                    @else
                                        <form action="{{ route('listing.submit.booking') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="referee_data_id" value="{{ Auth::user()->refereedata()->first()->id }}">
                                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                            <button type="submit" class="btn btn-black btn-md rounded full-width">Join Waiting List</button>
                                        </form>
                                    @endif
                                @endif
                                @elseif(Auth::user()->isOfType('agent'))
                                    <button type="submit" class="btn btn-black btn-md rounded full-width" data-bs-toggle="modal" data-bs-target="#view_users">Add Referee To Waiting List</button>
                                @else
                                    <p>Fill the Referral Form to Join the Waiting List for This Property</p>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </section>
    @push('scripts')
    <script>
        function selected() {
            var result = document.querySelector('input[name="referee_data_id"]:checked').value;
            if(result !=""){
                document.getElementById("add-users-button").removeAttribute('disabled');
            }
            else{
                document.getElementById("add-users-button").setAttribute('disabled', true);
            }
        }

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
</x-app-layout>
