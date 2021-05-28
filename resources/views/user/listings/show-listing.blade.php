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
                <div class="featured_slick_padd"><a href="{{ asset('storage/listing/images/'.$image->image_name) }}" class="mfp-gallery"><img src="{{ asset('storage/listing/images/'.$image->image_name) }}" class="img-fluid " alt="" /></a></div>
            @endforeach
        </div>
    </div>

    <section class="gray-simple rtl p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">
            
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
                                <button class="btn btn-theme-light-2 rounded" type="submit" style="margin-top: 20px">Make Enquiry</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
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
                                @foreach ($listing->other_rooms as $other_room)
                                    <li><strong>{{ $other_room }}</strong></li>
                                @endforeach
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
        </div>
    </section>

</x-app-layout>