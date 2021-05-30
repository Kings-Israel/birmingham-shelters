<x-app-layout pageTitle="User">
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
            @foreach ($listing->listingimage as $image)
                <div class="featured_slick_padd"><a href="{{ $image->url() }}" class="mfp-gallery"><img src="{{ $image->url() }}" class="img-fluid " alt="" /></a></div>
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
                                <img src="{{ asset('storage/listing/images/'.$listing->listingimage[1]->image_name) }}" class="img-fluid" width="400" alt="" />
                            </div>
                        </div>

                        <div class="pbw-flex">
                            <div class="prt-detail-title-desc">
                                <h3>{{ $listing->name }}</h3>
                                <h6>Local Authority Area: </h6><span>{{ $listing->local_authority_area }}</span><br>
                                <h6>Address: </h6><span>{{ $listing->address }}</span><br>
                                <h6>Postcode: </h6><span>{{ $listing->postcode }}</span>
                            </div>
                            <form action="{{ route('user.submit.inquiry') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                            </form>
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
                                    <li><strong>Bedsitting Rooms:</strong>{{ $listing->bedsitting_rooms }}</li>
                                    <li><strong>Toilets:</strong>{{ $listing->toilets }}</li>
                                    <li><strong>Kitchen:</strong>{{ $listing->kitchen }}</li>
                                </ul>
                                <br>
                                @if ($listing->other_rooms)
                                    <h5 class="property_block_title">Other Rooms</h5>
                                    <ul class="deatil_features">
                                        <li><strong>{{ $listing->other_rooms }}</strong></li>
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
                                    @foreach ($listing->features_list as $feature)
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
                                    @foreach ($listing->clientgroup->client_group_list as $client)
                                        <li>{{ $client }}</li>
                                    @endforeach
                                </ul>
                                <hr>
                                <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                                    <h6>How the facility will offer support</h6>
                                    <div class="block-body">
                                        <p>{{ $listing->clientgroup->support_description }}</p>
                                    </div>
                                </div>
                                <h6>Support Hours: <strong>{{ $listing->clientgroup->support_hours }}</strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    
                    <div class="details-sidebar">
                    
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
                            @auth
                            <form action="{{ route('user.submit.inquiry') }}" method="post">
                                @csrf
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <div class="sides-widget-body simple-form">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="listing_message" class="form-control">I'm interested in this property.</textarea>
                                    </div>
                                    <button class="btn btn-black btn-md rounded full-width">Send Message</button>
                                </div>
                            </form>
                            @endauth
                            @guest
                                <h4>Please <a href="{{ route('home') }}">Sign Up</a> Or <a href="{{ route('home') }}">Sign In</a> to make enquiries</h4>
                            @endguest
                        </div>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </section>

</x-app-layout>