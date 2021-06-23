<x-app-layout pageTitle="Income">
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
        <form action="{{ route('income-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="referee_data_id" value="{{ $refereeData->id }}">
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">
                    <div class="submit-section">
                        <div class="row">
                            <h5>SOURCE OF INCOME</h5>
                            <p>Section 2 of 6</p>
                            <div class="form-group col-md-12">
                                <label>Please select all that apply to the applicant</label>
                                <div class="o-features">
                                    <ul class="no-ul-list third-row">
                                        @for ($i = 0; $i < count($income_fields); $i++)
                                            <li>
                                                <input id="{{ $income_fields[$i] }}" class="checkbox-custom" name="source_of_income[]" value="{{ $income_fields[$i] }} {{ old($income_fields[$i]) }}" type="checkbox">
                                                <label for="{{ $income_fields[$i] }}" class="checkbox-custom-label">{{ $income_fields[$i] }}</label>
                                            </li>
                                        @endfor
                                    </ul>
                                    @error('source_of_income')
                                        <p class="error-message"><strong>{{ $message }}</strong></p>
                                    @enderror
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
                                    <textarea class="form-control h-40" id="other_debt_details" name="other_debt">{{ old('other_debt_details') }}</textarea>
                                    @error('other_debt_details')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</x-app-layout>