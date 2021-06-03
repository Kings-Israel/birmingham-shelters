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
            <form action="{{ route('health-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_metadata_id" value="{{ $id }}">
                <div class="submit-page">
                                
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5>HEALTH DETAILS</h5>
                        <div class="submit-section">
                            <p>Section 4 of 6</p>
                            <label>Social Worker/Community Psychiatric Nurse/Probation Officer or Other Relevant Professional(s)</label>
                            <input type="text" id="professional_officer" name="professional_officer" class="form-control" value="{{ old('professional_officer') }}">
                            @error('professional_officer')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>GP Name</label>
                                    <input type="text" id="gp_name" name="gp_name" class="form-control" value="{{ old('gp_name') }}">
                                    @error('gp_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>GP Address</label>
                                    <input type="text" id="gp_address" name="gp_address" class="form-control" value="{{ old('gp_address') }}">
                                    @error('gp_address')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <label>Has the client ever been detained/sectioned under the mental health act or community treatment order?</label>
                            <input id="a-1" class="checkbox-custom" name="detained_for_mental_health" type="radio" value="Yes" {{ (old('detained_for_mental_health') == 'Yes') ? 'checked' : '' }}>
                            <label for="a-1" class="checkbox-custom-label">Yes</label>
                            <input id="a-2" class="checkbox-custom" name="detained_for_mental_health" type="radio"  value="No" {{ (old('detained_for_mental_health') == 'No') ? 'checked' : '' }}>
                            <label for="a-2" class="checkbox-custom-label">No</label>
                            @error('detained_for_mental_health')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>Mental Health</label>
                                    <input type="text" id="mental_health" name="mental_health" class="form-control" value="{{ old('mental_health') }}">
                                    @error('mental_health')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Physical Health</label>
                                    <input type="text" id="physical_health" name="physical_health" class="form-control" value="{{ old('physical_health') }}">
                                    @error('physical_health')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>Present Medication or treatment</label>
                                    <input type="text" id="present_medication" name="present_medication" class="form-control" value="{{ old('present_medication') }}">
                                    @error('present_medication')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Details of current Care Plan Approach</label>
                                    <input type="text" id="current_cpa" name="current_cpa" class="form-control" value="{{ old('current_cpa') }}">
                                    @error('current_cpa')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <label>Any Other Relevant Information</label>
                            <textarea class="form-control h-120" id="other_relevant_information" name="other_relevant_information">{{ old('other_relevant_information') }}</textarea>
                            @error('other_relevant_information')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror

                            <br>
                            <div class="form-group">
                                <label>Does the client have any past, pending or current criminal offences?</label>
                                <input id="a-p" class="checkbox-custom" name="has_criminal_offence" type="radio" value="Yes" {{ (old('has_criminal_offence') == 'Yes') ? 'checked' : '' }}>
                                <label for="a-p" class="checkbox-custom-label">Yes</label>
                                <input id="a-q" class="checkbox-custom" name="has_criminal_offence" type="radio" value="No" {{ (old('has_criminal_offence') == 'No') ? 'checked' : '' }}>
                                <label for="a-q" class="checkbox-custom-label">No</label>
                                @error('has_criminal_offence')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>If Yes, Please provide details</label>
                                <textarea class="form-control h-120" id="criminal_offence_details" name="criminal_offence_details" value="{{ old('criminal_offence_details') }}"></textarea>
                                @error('criminal_offence_details')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="listing-submit-button">
                    @include('partials.listing-buttons')
                </div>
            </form>
        </div>
    </section>
</x-app-layout>