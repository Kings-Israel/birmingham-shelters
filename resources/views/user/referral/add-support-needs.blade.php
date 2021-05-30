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
                        <h5>SUPPORT GROUPS AND NEEDS</h5>
                        <div class="submit-section">
                            <p>Section 5 of 6</p>
                            <p><strong>*For each selected option please provide details of support information required</strong></p>
                            <br>

                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Mental Health Problems</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Single Homeless With Support Needs</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Training Educator Employment</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Leisure, Cultural, Faith, Informal Learning Activities</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Primary Health Care, Mental Health or Drug/Alcohol Services</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Accomodation/Housing</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Safeguarding: Avoid self-harm and/or causing harm to others/Avoid harming Others</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Independent Living Skills</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Inclusion in Community</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Social Isolation/Contact with family/friends</label>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Other</label>
                                        <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender') }}" required>
                                    </div>
                                    <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                        <label>Support Needs</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>
                                <br>
                                <div class="listing-submit-button">
                                    @include('partials.listing-buttons')
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>