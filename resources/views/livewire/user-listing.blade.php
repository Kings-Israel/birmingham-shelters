<div>
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="page-title">
        <div class="container">
            <div class="row justify-content-center">
                @include('partials.search')
            </div>
        </div>
    </div>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 list-layout">
                    <div class="row">
                        @if (count($listings) <= 0)
                            <h3 style="text-align: center">No Listings Found.</h3>
                        @else
                            @foreach ($listings as $listing)
                                <div class="col-lg-6 col-md-12">
                                    <div class="property-listing property-1">
                                        <div class="listing-img-wrapper">
                                            <a href="{{ route('listing.one', $listing) }}">
                                                <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid mx-auto" alt="" />
                                            </a>
                                        </div>
                                        <div class="listing-content">
                                            <div class="listing-detail-wrapper-box">
                                                <div class="listing-detail-wrapper">
                                                    <div class="listing-short-detail">
                                                        @if($listing->is_sponsored != null && $listing->is_sponsored > date('Y-m-d'))
                                                            <span class="badge rounded-pill fw-bold m-l-4" style="float: right; background-color: brown; color: #fff">Top</span>
                                                        @endif
                                                        @if ($listing->is_verified)
                                                            <i class="ti-star mr-1" style="float: right; font-size: 20px; color: brown"></i>
                                                        @endif
                                                        <h4 class="listing-name"><a href="{{ route('listing.one', $listing) }}">{{ $listing->name }}</a></h4>
                                                        <p class="listing-description">{{ $listing->description }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="listing-footer-wrapper">
                                                <div class="listing-locate">
                                                    <span class="listing-location"><i class="ti-location-pin"></i>{{ $listing->address }}</span>
                                                </div>
                                                <div class="listing-detail-btn">
                                                    <a href="{{ route('listing.one', $listing) }}" class="more-btn">View</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                {{ $listings->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
