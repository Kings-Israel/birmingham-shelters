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
            <form action="{{ route('consent-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="referee_data_id" value="{{ $id }}">
                <div class="submit-page">
                                
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5>APPLICANT CONSENT</h5>
                        <br>
                        <h5>REFERRAL AGENCY CONSENT</h5>
                        @if ($referral_type == 'Self Referral')
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="consent_name" value="{{ Auth::user()->full_name }}">
                                    @error('name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label>Date</label>
                                    <input type="date" id="date" class="form-control" name="consent_date">
                                    @error('date')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <label>Position in Company</label>
                                    <input type="text" class="form-control" name="consent_company_position" value="Person">
                                </div>
                            </div>
                        @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="consent_name">
                                @error('consent_name')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Date</label>
                                <input type="date" id="date" class="form-control" name="consent_date">
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <label>Position in Company</label>
                                <input type="text" id="consent_company_position" class="form-control" name="consent_company_position">
                                @error('consent_company_position')
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
            
                            <input id="agree_terms" class="checkbox-custom" name="terms-and_conditions" value="1" type="checkbox">
                            <label for="agree_terms" class="checkbox-custom-label">I agree to the terms stated above.</label>

                            <br>

                            <div class="listing-submit-button" id="submit_buttons" hidden>
                                @include('partials.referral-buttons')
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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

        let agreeTermsCheckbox = document.getElementById('agree_terms');
        let submitButtons = document.getElementById('submit_buttons');

        agreeTermsCheckbox.addEventListener('change', (e) => {
            if (submitButtons.hasAttribute('hidden')) {
                submitButtons.removeAttribute('hidden');
            } else {
                submitButtons.setAttribute('hidden', 'hidden');
            }
        })

    </script>
 @endpush
</x-app-layout>