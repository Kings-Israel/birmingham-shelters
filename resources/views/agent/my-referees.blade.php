<x-app-dashboard-layout pageTitle="Dashboard">

    <div class="row">
        <div class="col-lg-12 col-sm-12 list-layout">
            <div class="row">
                @if (count($referees) <= 0)
                    <span style="text-align: center">
                        <h3>You have not made any referees.</h3>
                        <h4><a href="{{ route('listing.all') }}">Click Here</a></h4><h6>to view available rooms</h6>
                    </span>
                @else
                @foreach ($referees as $referee)
                    <div class="col-lg-6 col-md-12">
                        <div class="property-listing property-1">
                            <div class="listing-img-wrapper">
                                <a href="single-property-2.html">
                                    <img src="{{ asset('storage/referee/image/'.$referee->applicant_image) }}" class="img-fluid mx-auto" alt="" />
                                </a>
                            </div>
                            <div class="listing-content">
                                
                                <div class="listing-detail-wrapper-box">
                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="single-property-2.html">{{ $referee->applicant_name }}</a></h4>
                                            <p class="listing-description">{{ $referee->applicant_email }}</p>
                                        </div>
                                    </div>
                                </div>
                            
                                {{-- <div class="listing-footer-wrapper">
                                    <div class="listing-locate">
                                        <span class="listing-location"><i class="ti-location-pin"></i>{{ $referee->listing->address }}</span>
                                    </div>
                                    <div class="listing-detail-btn">
                                        <a href="{{ route('listing.one', $referee->listing->id) }}" class="more-btn">View</a>
                                    </div>
                                </div> --}}
                                
                            </div>
                        </div>
                    </div>                      
                @endforeach

                <!-- Pagination -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <ul class="pagination p-center">
                            @if (!$referees->onFirstPage())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $referees->previousPageUrl() }}" aria-label="Previous">
                                    <span class="ti-arrow-left" disabled></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            @endif
                            <li class="page-item active"><a class="page-link" href="#">{{ $referees->currentPage() }}</a></li>
                            @if ($referees->hasPages())
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">{{ $referees->lastPage() }}</a></li>
                            @endif
                            @if ($referees->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $referees->nextPageUrl() }}" aria-label="Next">
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
