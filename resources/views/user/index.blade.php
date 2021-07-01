<x-app-dashboard-layout pageTitle="Dashboard">

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
                                    <img src="{!! $booking->listing->coverImageUrl() !!}" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="listing-content">
                                
                                <div class="listing-detail-wrapper-box">
                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            @if ($booking->listing->status->label == "Verified")
                                                <img src="{{ asset('/assets/img/star.png') }}" class="img-fluid" width="20px" style="float: right;"/>
                                            @endif
                                            <h4 class="listing-name"><a href="{{ route('listing.one', $booking->listing->id) }}">{{ $booking->listing->name }}</a></h4>
                                            <hr>
                                            <p class="listing-description">Status: <strong>{{ $booking->status }}</strong></p>
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
                                    @if ($booking->status == "Unsuccessful")
                                        <div class="listing-detail-btn">
                                            <a href="{{ url('/listing/booking/'.$booking->refereedata->user_id.'/'.$booking->refereedata->id.'/'.$booking->listing->id.'/delete') }}" class="delete-btn">Delete</a>
                                        </div>
                                    @endif
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

</x-app-dashboard-layout>
