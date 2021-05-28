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
                            <h5>PREVIOUS ADDRESSES INFO</h5>
                            <p>Section 3 of 4</p>
                            <div class="form-group col-md-12">
                                <label>Please enter the last 5 addresses that you have resided in</label>
                                <div class="row">
                                    @for ($i = 0; $i < 5; $i++)
                                        <div class="form-group col-md-2">
                                            <label>Address</label>
                                            <input type="text" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Moved in date</label>
                                            <input type="date" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Moved out date</label>
                                            <input type="date" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Tenure</label>
                                            <input type="text" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Landlord Details</label>
                                            <input type="text" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Reason for leaving</label>
                                            <input type="text" id="dwp_office" name="dwp_office" class="form-control" value="{{ old('dwp_office') }}">
                                            @error('dwp_office')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    @endfor
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