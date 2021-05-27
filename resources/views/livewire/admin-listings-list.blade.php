<div class="page-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">

                <div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard">
                    <div class="hero-search-content">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-12 b-r">
                                <div class="form-group">
                                    <div class="choose-propert-type">
                                        <ul>
                                            <li>
                                                <input id="cp-1" class="checkbox-custom" name="cpt" type="radio"
                                                    checked>
                                                <label for="cp-1" class="checkbox-custom-label">Buy</label>
                                            </li>
                                            <li>
                                                <input id="cp-2" class="checkbox-custom" name="cpt" type="radio">
                                                <label for="cp-2" class="checkbox-custom-label">Rent</label>
                                            </li>
                                            <li>
                                                <input id="cp-3" class="checkbox-custom" name="cpt" type="radio">
                                                <label for="cp-3" class="checkbox-custom-label">Sold</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-5 col-sm-12 p-0 elio">
                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input type="text" class="form-control" placeholder="Search for a location">
                                        <img src="{{ asset('assets/img/pin.svg')}}" width="20"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3 col-sm-12">
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
    <div class="container-md px-4">

        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="item-shorting-box">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left">
                            <h4 class="m-0">
                                Found 1-10 of {{ $this->listings->total() }} {{  Str::plural('Result', $this->listings->total())}}
                            </h4>
                        </div>
                    </div>
                    <div class="item-shorting-box-right">
                        <div class="shorting-by">
                            <select id="shorty" class="form-control">
                                <option value="">&nbsp;</option>
                                <option value="1">Low Price</option>
                                <option value="2">High Price</option>
                                <option value="3">Most Popular</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12 col-sm-12 list-layout">
                <div class="row">
                    @foreach ($this->listings as $listing)
                        <!-- Single Property Start -->
                        <div class="col-lg-6 col-md-6">
                            <div class="property-listing property-1">

                                <div class="listing-img-wrapper">
                                    <a href="{{ route('admin.listings.show', $listing->id) }}">
                                        <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid mx-auto" alt="" />
                                    </a>
                                </div>

                                <div class="listing-content">

                                    <div class="listing-detail-wrapper-box">
                                        <div class="listing-detail-wrapper">
                                            <div class="listing-short-detail">
                                                <h4 class="listing-name"><a href="{{ route('admin.listings.show', $listing->id) }}">{{ $listing->name }}</a></h4>

                                                <div class="d-flex">
                                                    @if ($listing->is_verified)
                                                        <span class="badge rounded-pill fw-bold text-success bg-light-success">Verified</span>
                                                    @else
                                                        <span class="badge rounded-pill fw-bold text-warning bg-light-warning">Not Verified</span>
                                                    @endif

                                                    @if($listing->is_available)
                                                        <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-4">Available</span>
                                                    @else
                                                        <span class="badge rounded-pill fw-bold text-warning bg-light-warning m-l-4">Not Available</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price-features-wrapper">
                                        <ul class="list-unstyled">
                                            <li><span class="fw-bold">Postcode:</span> {{ $listing->postcode }}</li>
                                            <li><span class="fw-bold">Local Authority:</span> {{ $listing->local_authority_area }}</li>
                                            <li><span class="fw-bold">Landlord:</span> {{ $listing->user->full_name }}</li>
                                        </ul>

                                    </div>

                                    <div class="listing-footer-wrapper">
                                        <div class="listing-locate">
                                            <span class="listing-location"><i class="ti-location-pin"></i>{{ $listing->address }}</span>
                                        </div>
                                        <div class="listing-detail-btn">
                                            <a href="{{ route('admin.listings.show', $listing->id) }}" class="more-btn">View</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- Single Property End -->
                    @endforeach
                </div>

                <div class="row">
                    {{ $this->listings->links() }}
                </div>
                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination p-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span class="ti-arrow-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item active"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">18</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span class="ti-arrow-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
