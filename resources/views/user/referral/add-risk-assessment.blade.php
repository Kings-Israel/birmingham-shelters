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
            <form action="{{ route('risk-assessment-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_metadata_id" value="{{ $id }}">
                <div class="submit-page">
                                
                    <!-- Basic Information -->
                    <div class="form-submit">
                        <h5>RISK ASSESSMENT</h5>
                        <div class="submit-section">
                            <p>Section 6 of 6</p>
                            <br>
                            <p><strong>Does the applicant have any history or risk of:</strong></p>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <p>Select risk level</p>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <p>Provide details(Triggers/Potential Victims etc.)</p>
                                </div>
                            </div>
                            @foreach ($risks_list as $risk)
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <input id="{{ $risk }}" class="checkbox-custom" name="risks[]" value="{{ $risk }}" type="checkbox">
                                        <label for="{{ $risk }}" class="checkbox-custom-label">{{ $risk }}</label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <input id="{{ $risk }}-Low" class="checkbox-custom" name="risk_level[{{ $risk }}]" value="Low {{ (old('risk_level[Low]')) ? 'checked' : '' }}" type="radio">
                                        <label for="{{ $risk }}-Low" class="checkbox-custom-label">Low</label>
                                        <input id="{{ $risk }}-Medium" class="checkbox-custom" name="risk_level[{{ $risk }}]" value="Medium {{ (old('risk_level[Medium]')) ? 'checked' : '' }}" type="radio">
                                        <label for="{{ $risk }}-Medium" class="checkbox-custom-label">Medium</label>
                                        <input id="{{ $risk }}-High" class="checkbox-custom" name="risk_level[{{ $risk }}]" value="High {{ (old('risk_level[High]')) ? 'checked' : '' }}" type="radio">
                                        <label for="{{ $risk }}-High" class="checkbox-custom-label">High</label>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <input type="text" class="form-control simple" name="risk_description[{{ $risk }}]" value="">
                                    </div>
                                    @error($risk)
                                        <p class="error-message"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <br>
                            @endforeach
                        </div>
                        <br>
                        <div class="listing-submit-button">
                            @include('partials.listing-buttons')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>