<x-app-layout pageTitle="User">
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
                <div class="col-lg-10 col-md-12">
                    
                    <h1 style="color: white; text-align:center">SUPPORTED ACCOMMODATION REFERRAL FORM</h1>
                    
                </div>
            </div>
        </div>
    </div>
    
   <!-- ============================ Add Listing Form ================================== -->
   <section class="bg-light">
    <div class="container-fluid">
        <form action="{{ route('listing.add.submit_basic_info') }}" class="listing-form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="referral_type" value="self-referral">
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">	
                    
                    <h6><strong>PLEASE READ CAREFULLY</strong></h6>
                    <p>Please ensure you enter the correct information as this form will be filled only once.</p>
                    <p>All sections of this form must be completed. Failure to do so may cause delays. If for any reason a section cannot be filled out, please state why. Blank sections will not be accepted.</p>
                    <p>It is important that applicants are aware that a bed space within our Supported Accommodation requires active engagement with key working sessions to address issues that may be linked to their homelessness.</p>
                    <p>In a case where the required value does not apply, please enter 'Not Applicable'</p>
                    
                    <br><hr>
                    <div class="submit-section">
                        <p>Section 1 of 6</p>
                        <div class="row">
                            <h5>REFERRAL CONTACT DETAILS</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Name of Referrer</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Referrer's Phone Number</label>
                                    <input type="text" id="referrer_phone_number" name="referrer_phone_number" class="form-control" value="{{ Auth::user()->phone_number }}" disabled required>
                                    @error('referrer_phone_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Referrer Email</label>
                                    <input type="text" id="referrer_email" name="referrer_email" class="form-control" value="{{ Auth::user()->email }}" disabled required>
                                    @error('referrer_email')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <label>Reason for referral (*This must be accurate.
                                    All referrals must be the definition of ‘Vulnerable Adult’.)</label>
                                <textarea class="form-control h-120" id="referral_reason" name="referral_reason" value="{{ old('referral_reason') }}" required></textarea>
                                @error('referral_reason')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="row">
                                <h5>APPLICATION CONTACT DETAILS</h5>
                                <input type="hidden" name="applicant_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                <input type="hidden" name="applicant_email" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                <input type="hidden" name="applicant_phone_number" value="{{ Auth::user()->phone_number }}">
                                <div class="form-group col-md-3">
                                    <label>Date of Birth</label>
                                    <input type="date" id="applicant_date_of_birth" name="applicant_date_of_birth" class="form-control" value="{{ old('applicant_date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>National Insurance Number</label>
                                    <input type="number" id="applicant_ni_address" name="applicant_ni_address" class="form-control" value="{{ old('applicant_ni_address') }}" required>
                                    @error('applicant_ni_address')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Current Address</label>
                                    <input type="text" id="current_address" name="current_address" class="form-control" value="{{ old('applicant_current_address') }}" required>
                                    @error('current_address')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>Gender</label>
                                    <input type="text" id="applicant_gender" name="applicant_gender" class="form-control" value="{{ old('applicant_gender') }}" required>
                                    @error('applicant_gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Name</label>
                                    <input type="text" id="applicant_kin_name" name="applicant_kin_name" class="form-control" value="{{ old('applicant_kin_name') }}" required>
                                    @error('applicant_kin_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin relationship</label>
                                    <input type="text" id="applicant_kin_relationship" name="applicant_kin_relationship" class="form-control" value="{{ old('applicant_kin_relationship') }}" required>
                                    @error('applicant_kin_relationship')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Phone Number</label>
                                    <input type="number" id="applicant_kin_phone_number" name="applicant_kin_phone_number" class="form-control" value="{{ old('applicant_kin_phone_number') }}" required>
                                    @error('applicant_kin_phone_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Email</label>
                                    <input type="email" id="applicant_kin_email" name="applicant_kin_email" class="form-control" value="{{ old('applicant_kin_email') }}" required>
                                    @error('applicant_kin_email')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Sexual Orientation</label>
                                    <input type="text" id="applicant_sexual_orientation" name="applicant_sexual_orientation" class="form-control" value="{{ old('applicant_sexual_orientation') }}" required>
                                    @error('applicant_sexual_orientation')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ethnic Group</label>
                                    <input type="text" id="applicant_ethnicity" name="applicant_ethnicity" class="form-control" value="{{ old('applicant_ethnicity') }}" required>
                                    @error('applicant_ethnicity')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <br>
                <div class="listing-submit-button">
                    @include('partials.listing-buttons')
                </div>
            
            </div>
        </form> 
    </div>
</section>
</x-app-layout>