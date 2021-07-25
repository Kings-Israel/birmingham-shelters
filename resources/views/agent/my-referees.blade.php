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
                                    <a href="{{ route('referees.referee', $referee->id) }}">
                                        <img src="{{ asset('storage/referee/image/'.$referee->applicant_image) }}" class="img-fluid mx-auto" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="listing-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="listing-detail-wrapper-box">
                                            <div class="listing-detail-wrapper">
                                                <div class="listing-short-detail">
                                                    <h4 class="listing-name"><a href="{{ route('referees.referee', $referee->id) }}">{{ $referee->applicant_name }}</a></h4>
                                                    <p class="listing-description">{{ $referee->applicant_email }}</p>
                                                    <p class="listing-description">+{{ $referee->applicant_phone_number }}</p>
                                                    @if ($referee->consent == false)
                                                        <p class="error-message">Cannot share user's info</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <div class="action">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#delete_listing_{{ $referee->id }}" class="delete">
                                            {{-- <i class="ti-close"></i> --}}
                                            <button class="btn btn-primary btn-md rounded">Delete Referee</button>
                                        </a>
                                        @if ($referee->consent == false)
                                            {{-- <livewire:info-consent :referee="$referee" /> --}}
                                            <button data-bs-toggle="modal" data-bs-target="#consent_{{ $referee->id }}" class="btn btn-theme-light-2 btn-md mt-2 rounded">Share Info</button>
                                        @endif
                                        </div>
                                    </div>
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
                    {{-- Consent Modal --}}
                    <div class="modal fade signup" id="consent_{{ $referee->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="sign-up" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                            <div class="modal-content" id="sign-up">
                                <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i
                                        class="ti-close"></i></span>
                                <div class="modal-body">
                                    <h4 class="text-center">Allow This User's Information to be shared
                                    </h4>
                                    <div class="login-form">
                                        <form method="POST" action="{{ route('consent-form.submit') }}">
                                            @csrf
                                            <input type="hidden" name="referee_data_id" value="{{ $referee->id }}">
                                            <input type="hidden" name="referee-list" value="true">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="consent_name" value="{{ Auth::user()->full_name }}">
                                                    @error('name')
                                                        <strong class="error-message">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Date</label>
                                                    <input type="date" id="date" class="form-control" name="consent_date">
                                                    @error('date')
                                                        <strong class="error-message">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                            </div>
                                            <label>Position in Company</label>
                                            <input type="text" id="consent_company_position" class="form-control" name="consent_company_position">
                                            @error('consent_company_position')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-md full-width btn-theme-light-2 rounded">Submit</button>
                                            </div>

                                        </form>
                                        <button type="submit" data-bs-dismiss="modal"
                                            class="btn btn-md full-width btn-primary rounded">Cancel</button>
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
@push('scripts')
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        let expiry_date_fields = document.querySelectorAll("#date");
        expiry_date_fields.forEach(field => {
            field.setAttribute("value", today);
        });
    </script>
@endpush
</x-app-dashboard-layout>
