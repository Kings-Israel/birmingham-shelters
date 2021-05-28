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
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">
                    <div class="submit-section">
                        <div class="row">
                            <h5>SOURCE OF INCOME</h5>
                            <p>Section 2 of 4</p>
                            <div class="form-group col-md-12">
                                <label>Please select all that apply to the applicant</label>
                                <div class="o-features">
                                    <ul class="no-ul-list third-row">
                                        <li>
                                            <input id="a-1" class="checkbox-custom" name="source_of_income[]" value="JSA" type="checkbox">
                                            <label for="a-1" class="checkbox-custom-label">JSA</label>
                                        </li>
                                        <li>
                                            <input id="a-2" class="checkbox-custom" name="source_of_income[]" value="DLA" type="checkbox">
                                            <label for="a-2" class="checkbox-custom-label">DLA</label>
                                        </li>
                                        <li>
                                            <input id="a-3" class="checkbox-custom" name="source_of_income[]" value="Incapacity Benefit/ESA" type="checkbox">
                                            <label for="a-3" class="checkbox-custom-label">Incapacity Benefit/ESA</label>
                                        </li>
                                        <li>
                                            <input id="a-4" class="checkbox-custom" name="source_of_income[]" value="Income Support" type="checkbox">
                                            <label for="a-4" class="checkbox-custom-label">Income Support</label>
                                        </li>
                                        <li>
                                            <input id="a-5" class="checkbox-custom" name="source_of_income[]" value="Pension" type="checkbox">
                                            <label for="a-5" class="checkbox-custom-label">Pension</label>
                                        </li>
                                        <li>
                                            <input id="a-6" class="checkbox-custom" name="source_of_income[]" value="UC" type="checkbox">
                                            <label for="a-6" class="checkbox-custom-label">UC</label>
                                        </li>
                                        <li>
                                            <input id="a-7" class="checkbox-custom" name="source_of_income[]" value="Working" type="checkbox">
                                            <label for="a-7" class="checkbox-custom-label">Working</label>
                                        </li>
                                        <li>
                                            <input id="a-8" class="checkbox-custom" name="source_of_income[]" value="None" type="checkbox">
                                            <label for="a-8" class="checkbox-custom-label">None</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>If Claiming Benefit, which DWP Office?</label>
                                    <input type="text" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                    @error('dwp_office')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Do you have any rent arrears or other debt? (Please provide details of any outstanding debt)</label>
                                    <textarea class="form-control h-40" id="other_debt_details" name="other_debt_details" value="{{ old('other_debt_details') }}" required></textarea>
                                    @error('other_debt_details')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="listing-submit-button">
                    @include('partials.listing-buttons')
                </div>
            </div>
        </form>
    </div>
   </section>
</x-app-layout>