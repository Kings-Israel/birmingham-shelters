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
                        <h5>HEALTH DETAILS</h5>
                        <div class="submit-section">
                            <p>Section 4 of 6</p>
                            <label>Social Worker/Community Psychiatric Nurse/Probation Officer or Other Relevant Professional(s)</label>
                            <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                            @error('referrer_name')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror
                            <label>GP Name and Address</label>
                            <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                            @error('referrer_name')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror
                            <br>
                            <label>Has the client ever been detained/sectioned under the mental health act or community treatment order?</label>
                            <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                            <label for="a-p" class="checkbox-custom-label">Yes</label>
                            <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                            <label for="a-p" class="checkbox-custom-label">No</label>
                            @error('referrer_name')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>Mental Health</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Physical Health</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label>Present Medication or treatment</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Details of current Care Plan Approach</label>
                                    <input type="text" id="referrer_name" name="referrer_name" class="form-control" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" disabled required>
                                    @error('referrer_name')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <label>Any Other Relevant Information</label>
                            <textarea class="form-control h-120" id="referral_reason" name="referral_reason" value="{{ old('referral_reason') }}" required></textarea>
                            @error('referral_reason')
                                <strong class="error-message">{{ $message }}</strong>
                            @enderror

                            <br>
                            <div class="form-group">
                                <label>Does the client have any past, pending or current criminal offences?</label>
                                <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                                <label for="a-p" class="checkbox-custom-label">Yes</label>
                                <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                                <label for="a-p" class="checkbox-custom-label">No</label>
                                @error('referrer_name')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>If Yes, Please provide details</label>
                                <textarea class="form-control h-120" id="referral_reason" name="referral_reason" value="{{ old('referral_reason') }}" required></textarea>
                                @error('referral_reason')
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