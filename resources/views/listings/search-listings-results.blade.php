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
    <div class="page-title">
        <div class="container">
            <div class="row justify-content-center">
                @include('partials.search')
            </div>
        </div>
    </div>
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="item-shorting-box">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left" @if(count($listings) <= 0) style="display: none" @endif><h4 class="m-0">Showing {{ $listings->currentPage() }}-{{ count($listings->items()) }} of {{ $listings->total() }} Results</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12 list-layout">
                    <div class="row">
                        @if (count($listings) <= 0)
                            <h3 style="text-align: center">No Listings have been found.</h3>
                        @else
                            @foreach ($listings as $listing)
                                <div class="col-lg-6 col-md-12">
                                    <div class="property-listing property-1">
                                        <div class="listing-img-wrapper">
                                            <a href="single-property-2.html">
                                                <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid mx-auto" alt="" />
                                            </a>
                                        </div>
                                        <div class="listing-content">
                                            
                                            <div class="listing-detail-wrapper-box">
                                                <div class="listing-detail-wrapper">
                                                    <div class="listing-short-detail">
                                                        {{-- TODO: Change the condition to show only when listing is verified --}}
                                                        @if ($listing->verified_at == null)
                                                            <img src="{{ asset('/assets/img/star.png') }}" class="img-fluid" width="20px" style="float: right;"/>
                                                        @endif
                                                        <h4 class="listing-name"><a href="{{ route('listing.one', $listing->id) }}">{{ $listing->name }}</a></h4>
                                                        <p class="listing-description">{{ $listing->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="listing-footer-wrapper">
                                                <div class="listing-locate">
                                                    <span class="listing-location"><i class="ti-location-pin"></i>{{ $listing->address }}</span>
                                                </div>
                                                <div class="listing-detail-btn">
                                                    <a href="{{ route('listing.one', $listing->id) }}" class="more-btn">View</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="pagination p-center">
                                        @if (!$listings->onFirstPage())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $listings->previousPageUrl() }}" aria-label="Previous">
                                                <span class="ti-arrow-left" disabled></span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="page-item active"><a class="page-link" href="#">{{ $listings->currentPage() }}</a></li>
                                        @if ($listings->hasPages())
                                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                                            <li class="page-item"><a class="page-link" href="#">{{ $listings->lastPage() }}</a></li>
                                        @endif
                                        @if ($listings->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $listings->nextPageUrl() }}" aria-label="Next">
                                                <span class="ti-arrow-right"></span>
                                                <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>