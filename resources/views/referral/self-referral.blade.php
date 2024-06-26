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
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="referral_type" value="Self Referral">
            <input type="hidden" name="referrer_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
            <input type="hidden" name="referrer_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="referrer_phone_number" value="{{ Auth::user()->phone_number }}">
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
                            <h5>REFERRAL CONTACT DETAILS</h5>
                            <p>The details you provided during registration will be used for contact</p>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Reason for referral (*This must be accurate.
                                            All referrals must be the definition of ‘Vulnerable Adult’.)</label>
                                        <textarea class="form-control h-120" id="referral_reason" name="referral_reason" required>{{ old('referral_reason') }}</textarea>
                                        @error('referral_reason')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Profile Image(Optional)</button>

                                        <div class="image-upload-wrap">
                                          <input class="file-upload-input" type='file' name="applicant_image" onchange="readURL(this);" accept="image/*" />
                                          <div class="drag-text">
                                            <h5>Drag and drop a file or select a Profile Image(optional)</h5>
                                          </div>
                                        </div>
                                        <div class="file-upload-content">
                                          <img class="file-upload-image" src="#" alt="your image" />
                                          <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">Remove</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5>APPLICATION CONTACT DETAILS</h5>
                                <input type="hidden" name="applicant_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                                <input type="hidden" name="applicant_email" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="applicant_phone_number" value="{{ Auth::user()->phone_number }}">

                                <div class="form-group col-md-3">
                                    <label>Date of Birth</label>
                                    <input type="date" id="date" name="applicant_date_of_birth" class="form-control" value="{{ old('applicant_date_of_birth') }}" required>
                                    @error('applicant_date_of_birth')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>National Insurance Number</label>
                                    <input type="text" id="applicant_ni_number" name="applicant_ni_number" class="form-control" value="{{ old('applicant_ni_number') }}" autocomplete="off" required>
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
                                    <input id="male" class="checkbox-custom" name="applicant_gender[]" type="radio" value="Male" {{ (old('applicant_gender.0') == 'Male') ? 'checked' : '' }} onchange="selected()">
                                    <label for="male" class="checkbox-custom-label">Male</label>
                                    <input id="female" class="checkbox-custom" name="applicant_gender[]" type="radio" value="Female" {{ (old('applicant_gender.0') == 'Female') ? 'checked' : '' }} onchange="selected()">
                                    <label for="female" class="checkbox-custom-label">Female</label>
                                    <input id="other" class="checkbox-custom" name="applicant_gender[]" type="radio" value="Other" {{ (old('applicant_gender.0') == 'Other') ? 'checked' : '' }} onchange="selected()">
                                    <label for="other" class="checkbox-custom-label">Other</label>
                                    <input type="text" id="applicant_gender" hidden name="applicant_gender[]" class="form-control" placeholder="Please specify" value="{{ old('applicant_gender.1') }}">
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
                                    <div class="input-with-icon">
                                        <select class="form-control" id="applicant_sexual_orientation" name="applicant_sexual_orientation" required>
                                            <option value="">Please select</option>
                                            <option value="Male" @if (old('applicant_sexual_orientation') == 'Male') selected="selected" @endif>Male</option>
                                            <option value="Female" @if (old('applicant_sexual_orientation') == 'Female') selected="selected" @endif>Female</option>
                                            <option value="Not Disclosed" @if (old('applicant_sexual_orientation') == 'Not Disclosed') selected="selected" @endif>Prefer Not to Disclose</option>
                                        </select>
                                        <i class="ti-user"></i>
                                    </div>
                                    @error('applicant_sexual_orientation')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ethnic Group</label>
                                    <div class="input-with-icon">
                                        <select class="form-control" id="applicant_ethnicity" name="applicant_ethnicity" required>
                                            <option value="">Please select</option>
                                            <option value="White" @if (old('applicant_ethnicity') == 'White') selected="selected" @endif>White</option>
                                            <option value="Black/ African/ Caribbean/ Black British/ Black Irish" @if (old('applicant_ethnicity') == 'Black/ African/ Caribbean/ Black British/ Black Irish') selected="selected" @endif>Black/ African/ Caribbean/ Black British/ Black Irish</option>
                                            <option value="Mixed/ Multiple Ethnic Groups" @if (old('applicant_ethnicity') == 'Mixed/ Multiple Ethnic Groups') selected="selected" @endif>Mixed/ Multiple Ethnic Groups</option>
                                            <option value="Asian/ British Asian/ Irish Asian" @if (old('applicant_ethnicity') == 'Asian/ British Asian/ Irish Asian') selected="selected" @endif>Asian/ British Asian/ Irish Asian</option>
                                            <option value="Other Ethnic Group" @if (old('applicant_ethnicity') == 'Other Ethnic Group') selected="selected" @endif>Other Ethnic Group</option>
                                            <option value="Not Disclosed" @if (old('applicant_ethnicity') == 'Not Disclosed') selected="selected" @endif>Prefer Not To Disclose</option>
                                        </select>
                                        <i class="ti-user"></i>
                                    </div>
                                    @error('applicant_ethnicity')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
                <br>
                <div class="listing-submit-button">
                    <div class="form-group col-lg-12 col-md-12" id="listing-buttons">
                        <a href="{{ route('referee.cancel', $refereeData->id ?? '') }}" class="btn btn-md btn-outline-theme">
                            Cancel
                        </a>
                        <button class="btn btn-theme-light-2 rounded" type="submit">Submit</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>
@push('scripts')
    <script>
        let applicant_kin_phone_number = document.getElementById('applicant_kin_phone_number')

        applicant_kin_phone_number.addEventListener('focus', () => {
            applicant_kin_phone_number.value = '07'
        })
        function selected() {
            var result = document.querySelector('input[name="applicant_gender[]"]:checked').value;
            if(result == "Other"){
                document.getElementById("applicant_gender").removeAttribute('hidden');
                document.getElementById("applicant_gender").setAttribute('required', true)
            }
            else{
                document.getElementById("applicant_gender").setAttribute('hidden', true);
            }
        }
    </script>
@endpush
</x-app-layout>
