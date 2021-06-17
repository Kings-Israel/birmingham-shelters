<x-app-layout pageTitle="Address">
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
        <form action="{{ route('address-form.submit') }}" class="listing-form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="referee_data_id" value="{{ $refereeData->id }}">
            <div class="submit-page">
                            
                <!-- Basic Information -->
                <div class="form-submit">
                    <div class="submit-section">
                        <div class="row">
                            <h5>PREVIOUS ADDRESSES INFO</h5>
                            <p>Section 3 of 6</p>
                            <div class="form-group col-md-12">
                                <label>Please enter the last 4 addresses that you have resided in (At least one is required)</label>
                                @if ($errors->any())
                                    <p class="error-message"><strong>{{ $errors->first() }}</strong></p>
                                @endif
                                <div class="row">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="form-group col-md-2">
                                            <label>Address</label>
                                            <input type="text" id="address" name="address[]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Moved in date</label>
                                            <input type="date" id="date" name="moved_in_date[]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Moved out date</label>
                                            <input type="date" id="date" name="moved_out_date[]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Tenure</label>
                                            <input type="text" id="tenure" name="tenure[]" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Landlord Details</label>
                                            <input type="text" id="landlord_details" name="landlord_details[]" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Reason for leaving</label>
                                            <input type="text" id="reason_for_leaving" name="reason_for_leaving[]" class="form-control" >
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="listing-submit-button">
                    @include('partials.referral-buttons')
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
           field.setAttribute("max", today);
       });
   </script>
@endpush
</x-app-layout>