<x-app-dashboard-layout pageTitle="Dashboard">
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-1">
                <div class="dashboard-stat-content">
                    <h4>{{ count($bookings) }}</h4> <span>Listings Booked</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-2">
                <div class="dashboard-stat-content">
                    <h4>{{ count($referees) }}</h4> <span>Referees</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
            </div>
        </div>

    </div>
    @if (count($bookings) > 0)
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h4>Your <span class="pc-title theme-cl">Booked Listings</span></h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-sm-12 list-layout">
                <div class="row">
                    @if (count($bookings) <= 0)
                        <span style="text-align: center">
                            <h3>You have not made any bookings.</h3>
                            <h4><a href="{{ route('listing.all') }}">Click Here</a></h4><h6>to view available rooms</h6>
                        </span>
                    @else
                    @foreach ($bookings as $booking)
                        <div class="col-lg-6 col-md-12">
                            <div class="property-listing property-1">
                                <div class="listing-img-wrapper">
                                    <a href="{{ route('listing.one', $booking->listing->id) }}">
                                        <img src="{{ asset('storage/listing/images/'.$booking->listing->listingimage[0]->image_name) }}" class="img-fluid mx-auto" alt="" />
                                    </a>
                                </div>
                                <div class="listing-content">
                                    
                                    <div class="listing-detail-wrapper-box">
                                        <div class="listing-detail-wrapper">
                                            <div class="listing-short-detail">
                                                {{-- TODO: Change the condition to show only when listing is verified --}}
                                                @if ($booking->listing->verified_at == null)
                                                    <img src="{{ asset('/assets/img/star.png') }}" class="img-fluid" width="20px" style="float: right;"/>
                                                @endif
                                                <h4 class="listing-name"><a href="{{ route('listing.one', $booking->listing->id) }}">{{ $booking->listing->name }}</a></h4>
                                                <p class="listing-description">{{ $booking->listing->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="listing-footer-wrapper">
                                        <div class="listing-locate">
                                            <span class="listing-location"><i class="ti-location-pin"></i>{{ $booking->listing->address }}</span>
                                        </div>
                                        <div class="listing-detail-btn">
                                            <a href="{{ route('listing.one', $booking->listing->id) }}" class="more-btn">View</a>
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
                                @if (!$bookings->onFirstPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" aria-label="Previous">
                                        <span class="ti-arrow-left" disabled></span>
                                        <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="page-item active"><a class="page-link" href="#">{{ $bookings->currentPage() }}</a></li>
                                @if ($bookings->hasPages())
                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">{{ $bookings->lastPage() }}</a></li>
                                @endif
                                @if ($bookings->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-label="Next">
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
    @endif

</x-app-dashboard-layout>
