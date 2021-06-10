<x-app-dashboard-layout pageTitle="Dashboard">

    <div class="row">
        <div class="col-lg-12 col-sm-12 list-layout">
            <div class="row">
                @if (count($referees) <= 0)
                    <span style="text-align: center">
                        <h3>You have not made any referees.</h3>
                        <h4><a href="{{ route('referral.agency-referral') }}">Click Here</a></h4><h6>to add referees</h6>
                    </span>
                @else
                @foreach ($referees as $referee)
                    <div class="col-lg-6 col-md-12">
                        <div class="property-listing property-1">
                            <div class="listing-img-wrapper">
                                <div class="sd-list-left">
                                    <a href="{{ route('agent.referees.referee', $referee->id) }}">
                                        <img src="{{ asset('storage/referee/image/'.$referee->applicant_image) }}" class="img-fluid mx-auto" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="listing-content sd-list-right">
                                
                                <div class="listing-detail-wrapper-box">
                                    <div class="listing-detail-wrapper">
                                        <div class="listing-short-detail">
                                            <h4 class="listing-name"><a href="{{ route('agent.referees.referee', $referee->id) }}">{{ $referee->applicant_name }}</a></h4>
                                            <p class="listing-description">{{ $referee->applicant_email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="action">
                                <a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                    data-bs-target="#delete_listing_{{ $referee->id }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Delete Referee" class="delete"><i
                                        class="ti-close"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>  
                    {{-- Delete Referee Modal --}}
                    <div class="modal fade signup" id="delete_listing_{{ $referee->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="sign-up" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                            <div class="modal-content" id="sign-up">
                                <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i
                                        class="ti-close"></i></span>
                                <div class="modal-body">
                                    <h4 class="text-center">Are you Sure you Want to delete {{ $referee->applicant_name }}?
                                    </h4>
                                    <div class="login-form">
                                        <form method="POST" action="{{ route('referee.delete', $referee->id) }}">
                                            @csrf
                                            @method('DELETE')
    
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-md full-width btn-primary rounded">Delete</button>
                                            </div>
    
                                        </form>
                                        <button type="submit" data-bs-dismiss="modal"
                                            class="btn btn-md full-width btn-theme-light-2 rounded">Cancel</button>
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
