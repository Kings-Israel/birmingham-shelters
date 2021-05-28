<x-app-layout pageTitle="User">
    <div class="page-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    
                    <div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard">
                        <div class="hero-search-content">
                            <div class="row">
                                <div class="col-lg-9 col-md-7 col-sm-12 elio">
                                    <div class="form-group">
                                        <div class="input-with-icon">
                                            <input type="text" class="form-control" placeholder="Search for a location">
                                            <img src="{{ asset('assets/img/pin.svg') }}" width="20"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3 col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <a href="#" class="btn search-btn black">Search</a>
                                    </div>
                                </div>
                                        
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="item-shorting-box">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left"><h4 class="m-0">Showing 1-10 of 142 Results</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 list-layout">
                    <div class="row">
                        @foreach ($listings as $listing)
                            <div class="col-lg-6 col-md-12">
                                <div class="property-listing property-1">
                                    <div class="listing-img-wrapper">
                                        <a href="single-property-2.html">
                                            <img src="{{ asset('storage/listing/images/'.$listing->listingimage[0]->image_name) }}" class="img-fluid mx-auto" alt="" />
                                        </a>
                                    </div>
                                    <div class="listing-content">
										
                                        <div class="listing-detail-wrapper-box">
                                            <div class="listing-detail-wrapper">
                                                <div class="listing-short-detail">
                                                    <h4 class="listing-name"><a href="single-property-2.html">{{ $listing->name }}</a></h4>
                                                    <p class="listing-description">{{ $listing->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="listing-footer-wrapper">
                                            <div class="listing-locate">
                                                <span class="listing-location"><i class="ti-location-pin"></i>Quice Market, Canada</span>
                                            </div>
                                            <div class="listing-detail-btn">
                                                <a href="{{ route('user.listing.one', $listing->id) }}" class="more-btn">View</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>