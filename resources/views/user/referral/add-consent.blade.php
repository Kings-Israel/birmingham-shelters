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

    <section class="bg-light">
        <div class="container-fluid">
            <form action="{{ route('listing.add.submit_basic_info') }}" class="listing-form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="submit-page">
                                
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5>APPLICANT CONSENT</h5>
                        <div class="submit-section">
                            <p>Section 6 of 6</p>
                            <br>
                            <ul class="no-ul-list">
                                @foreach ($consent_fields as $field)                            
                                    <li>
                                        <input id="{{ $field }}" class="checkbox-custom" name="{{ $field }}" type="checkbox">
                                        <label for="{{ $field }}" class="checkbox-custom-label">{{ $field }}</label>
                                    </li>
                                @endforeach
							</ul>
                        </div>
                        <br>
                        <h5>REFERRAL AGENCY CONSENT</h5>
                        @if ($referral_type === 'self')
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                    @error('family_home_area')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-md-6 col-sm-12">
                                    <label>Date</label>
                                    <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                    @error('family_home_area')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-md-6 col-sm-12">
                                    <label>Position in Company</label>
                                    <input type="text" class="form-control" name="family_home_area" value="Person">
                                </div>
                            </div>
                        @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                @error('family_home_area')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Date</label>
                                <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                @error('family_home_area')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <label>Position in Company</label>
                                <input type="text" class="form-control" name="family_home_area" value="{{ old('family_home_area') }}">
                                @error('family_home_area')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <br>
                        <h5>
                            Data Protection Statement /Declaration
                            (MUST BE SIGNED BY SERVICE USER OR REFERRER)</h5>
                            <p>We gather information to identify if our services meet your needs; prove what we do and who we support .Some of this information may be sensitive but will be stored securely on our computer system and treated as confidential. The Data Protection Act 1998 says that we must get your consent to hold this information.
                                I understand this statement and consent to it; I also confirm that the information provided in this referral form is true, accurate and can be used as part of the Sheltered Housing assessment process.
                                I also authorise a representative of Sheltered Housing to discuss any issues, and act on my behalf, regarding me getting an appropriate accommodation.</p>
            
                            <input id="a-18" class="checkbox-custom" name="terms-and_conditions" value="1" type="checkbox">
                            <label for="a-18" class="checkbox-custom-label">I agree to the terms stated above.</label>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>