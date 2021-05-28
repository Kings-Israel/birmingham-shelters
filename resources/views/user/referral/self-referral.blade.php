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
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">	
                    
                    <h6><strong>PLEASE READ CAREFULLY</strong></h6>
                    <p>All sections of this form must be completed. Failure to do so may cause delays. If for any reason a section cannot be filled out, please state why. Blank sections will not be accepted. Thank you.</p>
                    <p>It is important that applicants are aware that a bed space within our Supported Accommodation requires active engagement with key working sessions to address issues that may be linked to their homelessness.</p>
                    <br><hr>
                    <div class="submit-section">
                        <p>Section 1 of 4</p>
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
                                <div class="form-group col-md-3">
                                    <label>Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    @error('date_of_birth')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>National Insurance Number</label>
                                    <input type="number" id="ni_number" name="ni_number" class="form-control" value="{{ old('ni_number') }}" required>
                                    @error('ni_number')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Gender</label>
                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    @error('gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Current Address</label>
                                    <input type="text" id="current_address" name="current_address" class="form-control" value="{{ old('current_address') }}" required>
                                    @error('current_address')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Name</label>
                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    @error('gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin relationship</label>
                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    @error('gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Phone Number</label>
                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    @error('gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Next of Kin Email</label>
                                    <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    @error('gender')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Sexual Orientation</label>
                                    <input type="text" id="sexual_orientation" name="sexual_orientation" class="form-control" value="{{ old('sexual_orientation') }}" required>
                                    @error('sexual_orientation')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ethnic Group</label>
                                    <input type="text" id="ethnic_group" name="ethnic_group" class="form-control" value="{{ old('ethnic_group') }}" required>
                                    @error('ethnic_group')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <h5>RISK AND NEEDS</h5>
                            <div class="form-group col-md-12">
                                <label>Please indicate by checking the boxes, whether the applicant has any of the following risks.</label>
                                <div class="o-features">
                                    <ul class="no-ul-list third-row">
                                        <li>
                                            <input id="a-1" class="checkbox-custom" name="risk_and_needs[]" value="Drug Abuse" type="checkbox">
                                            <label for="a-1" class="checkbox-custom-label">Drug Abuse</label>
                                        </li>
                                        <li>
                                            <input id="a-2" class="checkbox-custom" name="risk_and_needs[]" value="Physical and Sensory Disability" type="checkbox">
                                            <label for="a-2" class="checkbox-custom-label">Physical and Sensory Disability</label>
                                        </li>
                                        <li>
                                            <input id="a-3" class="checkbox-custom" name="risk_and_needs[]" value="Alcohol Misuse" type="checkbox">
                                            <label for="a-3" class="checkbox-custom-label">Alcohol Misuse</label>
                                        </li>
                                        <li>
                                            <input id="a-4" class="checkbox-custom" name="risk_and_needs[]" value="Mental Health" type="checkbox">
                                            <label for="a-4" class="checkbox-custom-label">Mental Health</label>
                                        </li>
                                        <li>
                                            <input id="a-5" class="checkbox-custom" name="risk_and_needs[]" value="Arson" type="checkbox">
                                            <label for="a-5" class="checkbox-custom-label">Arson</label>
                                        </li>
                                        <li>
                                            <input id="a-6" class="checkbox-custom" name="risk_and_needs[]" value="Learning Disablities" type="checkbox">
                                            <label for="a-6" class="checkbox-custom-label">Learning Disablities</label>
                                        </li>
                                        <li>
                                            <input id="a-7" class="checkbox-custom" name="risk_and_needs[]" value="Sex Offender" type="checkbox">
                                            <label for="a-7" class="checkbox-custom-label">Sex Offender</label>
                                        </li>
                                        <li>
                                            <input id="a-8" class="checkbox-custom" name="risk_and_needs[]" value="People with support/complex needs" type="checkbox">
                                            <label for="a-8" class="checkbox-custom-label">People with support/complex needs</label>
                                        </li>
                                        <li>
                                            <input id="a-9" class="checkbox-custom" name="risk_and_needs[]" value="Ex-Offender" type="checkbox">
                                            <label for="a-9" class="checkbox-custom-label">Ex-Offender</label>
                                        </li>
                                        <li>
                                            <input id="a-10" class="checkbox-custom" name="risk_and_needs[]" value="Refugees" type="checkbox">
                                            <label for="a-10" class="checkbox-custom-label">Refugees</label>
                                        </li>
                                        <li>
                                            <input id="a-11" class="checkbox-custom" name="risk_and_needs[]" value="Self-Harm" type="checkbox">
                                            <label for="a-11" class="checkbox-custom-label">Self-Harm</label>
                                        </li>
                                        <li>
                                            <input id="a-12" class="checkbox-custom" name="risk_and_needs[]" value="HIV/AIDS" type="checkbox">
                                            <label for="a-12" class="checkbox-custom-label">HIV/AIDS</label>
                                        </li>
                                        <li>
                                            <input id="a-13" class="checkbox-custom" name="risk_and_needs[]" value="Domestic Abuse" type="checkbox">
                                            <label for="a-13" class="checkbox-custom-label">Domestic Abuse</label>
                                        </li>
                                        <li>
                                            <input id="a-14" class="checkbox-custom" name="risk_and_needs[]" value="Other People with Support needs" type="checkbox">
                                            <label for="a-14" class="checkbox-custom-label">Other People with Support needs</label>
                                        </li>
                                        <li>
                                            <input id="a-15" class="checkbox-custom" name="risk_and_needs[]" value="Sectioned/Detained" type="checkbox">
                                            <label for="a-15" class="checkbox-custom-label">Sectioned/Detained</label>
                                        </li>
                                        <li>
                                            <input id="a-16" class="checkbox-custom" name="risk_and_needs[]" value="Young People leaving care" type="checkbox">
                                            <label for="a-16" class="checkbox-custom-label">Young People leaving care</label>
                                        </li>
                                    </ul>
                                    <p><strong>**If on probation, Probation officer will be required to send Accommodation in Partnership form, Pre-Sentence Reports and Risk Assessment.</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Please provide details, If the answer is yes to any of the risks and needs stated in the section above.</label>
                                    <textarea class="form-control h-40" id="risk_and_needs_history" name="risk_and_needs_history" value="{{ old('risk_and_needs_history') }}" required></textarea>
                                    @error('risk_and_needs_history')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-submit">
                    <div class="submit-section">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Do you have any Social worker/CPN/Probation officer or other relevant professional(s)</label>
                                <input type="text" class="form-control" name="professional_officer" value="{{ old('professional_officer') }}" required>
                                @error('professional_officer')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>What is the reason you first became Homeless?( If prison, release date and details please.)</label>
                                <input type="text" class="form-control" name="reason_for_homelessness" value="{{ old('reason_for_homelessness') }}" required>
                                @error('reason_for_homelessness')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>In which area/town do you have Connections/family?</label>
                                <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                @error('family_home_area')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Is there any area of Birmingham where you are unable to live? Why?</label>
                                <textarea class="form-control h-40" id="area_unable_to_live" name="area_unable_to_live" value="{{ old('area_unable_to_live') }}" required></textarea>
                                @error('area_unable_to_live')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <input id="a-17" class="checkbox-custom" name="has_pets" value="1" type="checkbox">
                        <label for="a-17" class="checkbox-custom-label">Do you have any pets? (We do not accomodate anyone with pets)</label>
                    </div>
                </div>
                <br><hr>
                <h5>
                Data Protection Statement /Declaration
                (MUST BE SIGNED BY SERVICE USER OR REFERRER)</h5>
                <p>We gather information to identify if our services meet your needs; prove what we do and who we support .Some of this information may be sensitive but will be stored securely on our computer system and treated as confidential. The Data Protection Act 1998 says that we must get your consent to hold this information.
                    I understand this statement and consent to it; I also confirm that the information provided in this referral form is true, accurate and can be used as part of the Sheltered Housing assessment process.
                    I also authorise a representative of Sheltered Housing to discuss any issues, and act on my behalf, regarding me getting an appropriate accommodation.</p>

                <input id="a-18" class="checkbox-custom" name="terms-and_conditions" value="1" type="checkbox">
                <label for="a-18" class="checkbox-custom-label">I agree to the terms stated above.</label>
                <br>
                <div class="listing-submit-button">
                    @include('partials.listing-buttons')
                </div>
            
            </div>
        </form> 
    </div>
</section>
</x-app-layout>