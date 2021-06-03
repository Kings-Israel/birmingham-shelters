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
        <form action="{{ route('referral-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="referral_type" value="agency-referral">
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">	
                    
                    <h6><strong>PLEASE READ CAREFULLY</strong></h6>
                    <p>Please ensure you enter the correct information as this form will be filled only once.</p>
                    <p>All sections of this form must be completed. Failure to do so may cause delays. If for any reason a section cannot be filled out, please state why. Blank sections will not be accepted.</p>
                    <p>It is important that applicants are aware that a bed space within our Supported Accommodation requires active engagement with key working sessions to address issues that may be linked to their homelessness.</p>
                    <p>In a case where the required value does not apply, please enter 'Not Applicable'</p>


                    <div class="submit-section">
                        <div class="row">
                            <h5>REFERRAL AGENCY CONTACT DETAILS</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Name of Referrer</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ old('referrer_name') }}" required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Referrer's Phone Number</label>
                                    <input type="text" id="referrer_phone_number" name="referrer_phone_number" class="form-control" value="{{ old('referrer_phone_number') }}" required>
                                    @error('referrer_phone_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Name of Referrer</label>
                                    <input type="text" id="referrer_email" name="referrer_email" class="form-control" value="{{ old('referrer_email') }}" required>
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
                            <h5>APPLICATION CONTACT DETAILS</h5>

                            <div class="row">
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>Applicant's Name</label>
                                    <input type="text" id="applicant_name" name="applicant_name" class="form-control" value="{{ old('applicant_name') }}" required>
                                    @error('applicant_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>Applicant's Email Address</label>
                                    <input type="email" id="applicant_email" name="applicant_email" class="form-control" value="{{ old('applicant_email') }}" required>
                                    @error('applicant_email')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>Applicant's Phone Number</label>
                                    <input type="number" id="applicant_phone_number" name="applicant_phone_number" class="form-control" value="{{ old('applicant_phone_number') }}" required>
                                    @error('applicant_phone_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Date of Birth</label>
                                    <input type="date" id="applicant_date_of_birth" name="applicant_date_of_birth" class="form-control" value="{{ old('applicant_date_of_birth') }}" required>
                                    @error('applicant_date_of_birth')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>NI Number</label>
                                    <input type="number" id="applicant_ni_number" name="applicant_ni_number" class="form-control" value="{{ old('applicant_ni_number') }}" required>
                                    @error('applicant_ni_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Current Address</label>
                                    <input type="text" id="applicant_current_address" name="applicant_current_address" class="form-control" value="{{ old('applicant_current_address') }}" required>
                                    @error('applicant_current_address')
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
                                    <label>Next of Kin's Name</label>
                                    <input type="text" id="applicant_kin_name" name="applicant_kin_name" class="form-control" value="{{ old('applicant_kin_name') }}" required>
                                    @error('applicant_kin_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin's relationship</label>
                                    <input type="text" id="applicant_kin_relationship" name="applicant_kin_relationship" class="form-control" value="{{ old('applicant_kin_relationship') }}" required>
                                    @error('applicant_kin_relationship')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin's Phone Number</label>
                                    <input type="number" id="applicant_kin_phone_number" name="applicant_kin_phone_number" class="form-control" value="{{ old('applicant_kin_phone_number') }}" required>
                                    @error('applicant_kin_phone_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin's Email</label>
                                    <input type="text" id="applicant_kin_email" name="applicant_kin_email" class="form-control" value="{{ old('applicant_kin_email') }}" required>
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
                    @include('partials.referral-buttons')
                </div>
            
            </div>
        </form> 
    </div>
</section>
</x-app-layout>