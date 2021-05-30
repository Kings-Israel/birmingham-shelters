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
                        <h5>RISK ASSESSMENT</h5>
                        <div class="submit-section">
                            <p>Section 5 of 6</p>
                            <br>
                            <p><strong>Does the applicant have any history of:</strong></p>
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
                                        <input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">{{ $risk }}</label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                                        <label for="a-p" class="checkbox-custom-label">Low</label>
                                        <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                                        <label for="a-p" class="checkbox-custom-label">Medium</label>
                                        <input id="a-p" class="checkbox-custom" name="a-p" type="radio">
                                        <label for="a-p" class="checkbox-custom-label">High</label>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12">
                                        <input type="text" class="form-control simple">
                                    </div>
                                </div>
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