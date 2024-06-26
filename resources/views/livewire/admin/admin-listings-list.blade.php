<div>
    <x-breadcrumb :items="$breadcrumb" />

    <div class="page-title">
        <div class="container">
            <div class="row justify-content-center">
                @include('partials.search')
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
                                <div class="left-column pull-left" @if(count($listings) <= 0) style="display: none" @endif><h4 class="m-0">Showing {{ $listings->currentPage() }}-{{ count($listings->items()) }} of {{ $listings->total() }} Results</h4></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-sm-12 list-layout">
                    <div class="row">
                        @foreach ($listings as $listing)
                            <!-- Single Property Start -->
                            <div class="col-lg-6 col-md-6">
                                <div class="property-listing property-1">

                                    <div class="listing-img-wrapper">
                                        <a href="{{ route('admin.listings.show', $listing) }}">
                                            <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid mx-auto" alt="" />
                                        </a>
                                    </div>

                                    <div class="listing-content">

                                        <div class="listing-detail-wrapper-box">
                                            <div class="listing-detail-wrapper">
                                                <div class="listing-short-detail">
                                                    <h4 class="listing-name"><a href="{{ route('admin.listings.show', $listing) }}">{{ $listing->name }}</a></h4>

                                                    <div class="d-flex">
                                                        @if ($listing->is_verified)
                                                            <span class="badge rounded-pill fw-bold text-success bg-light-success">Verified</span>
                                                        @else
                                                            <span class="badge rounded-pill fw-bold text-warning bg-light-warning">Not Verified</span>
                                                        @endif

                                                        @if($listing->is_available)
                                                            <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-5">Available</span>
                                                        @else
                                                            <span class="badge rounded-pill fw-bold text-warning bg-light-warning m-l-5">Not Available</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="price-features-wrapper">
                                            <ul class="list-unstyled">
                                                <li><span class="fw-bold">Postcode:</span> {{ $listing->postcode }}</li>
                                                <li><span class="fw-bold">Landlord:</span> {{ $listing->user->full_name }}</li>
                                            </ul>

                                        </div>

                                        <div class="listing-footer-wrapper">
                                            <div class="listing-locate">
                                                <span class="listing-location"><i class="ti-location-pin"></i>{{ $listing->address }}</span>
                                            </div>
                                            <div class="listing-detail-btn">
                                                <a href="{{ route('admin.listings.show', $listing) }}" class="more-btn">View</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- Single Property End -->
                        @endforeach
                    </div>

                    <div class="row">
                        {{ $listings->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
