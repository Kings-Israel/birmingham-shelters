<x-app-layout pageTitle="Landlord">
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif

   <!-- ============================ Add Listing Form ================================== -->
   <section class="bg-light">
    <div class="container-fluid">
                    
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="filter_search_opt">
                    <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i class="ml-2 ti-menu"></i></a>
                </div>
            </div>
        </div>
                    
        <div class="row">
            
            <div class="col-lg-3 col-md-12">
                @include('partials.landlord-sidenav')
            </div>
            
            <div class="col-lg-9 col-md-12">
                <form action="{{ route('listing.add.submit_documents') }}" class="listing-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $id }}">
                <div class="submit-page">
								
                    <!-- Basic Information -->
                    <div class="form-submit">	
                        <h3>Property Documents</h3>
                        <p>Step 3 of 4</p>
                        <br>
                        <p>N.B: <strong>All documents should be in PDF format.</strong></p>
                        {{-- Gas Certificate --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Gas Certificate:</label>
                                <input type="file" name="gas_certificate" id="" class="form-control" accept=".pdf" value="{{ old('gas_certificate') }}">
                                @error('gas_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="gas_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('gas_certificate_expiry_date') }}">
                                @error('gas_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End Gas Certificate --}}
                        
                        {{-- Electrical Installation Report --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Electrical Installation Report:</label>
                                <input type="file" name="electrical_certificate" id="" class="form-control" accept=".pdf" value="{{ old('electrcal_certificate') }}">
                                @error('electrical_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="electrical_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('electrical_certificate_expiry_date') }}">
                                @error('electrical_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of Electrical Installation Report --}}

                        {{-- Fire alarm/smoke detectors --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fire Alarm/Smoke Detectors:</label>
                                <input type="file" name="detectors_certificate" id="" class="form-control" accept=".pdf" value="{{ old('detectors_certificate') }}">
                                @error('detectors_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="detectors_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('detectors_certificate_expiry_date') }}">
                                @error('detectors_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of fire alarm/smoke detectors --}}

                        {{-- Emergenct y Lighting --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Emergency Lighting:</label>
                                <input type="file" name="emergency_lighting_certificate" id="" class="form-control" accept=".pdf" value="{{ old('emergency_lighting_certificate') }}">
                                @error('emergency_lighting_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="emergency_lighting_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('emergency_lighting_certificate_expiry_date') }}">
                                @error('emergency_lighting_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of Emergency Lighting --}}

                        {{-- Fire Risk Assessment --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fire Risk Assessment:</label>
                                <input type="file" name="fire_risk_certificate" id="" class="form-control" accept=".pdf" value="{{ old('fire_risk_certificate') }}">
                                @error('fire_risk_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="fire_risk_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('fire_risk_certificate_expiry_date') }}">
                                @error('fire_risk_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of Fire Risk Assessment --}}

                        {{-- PAT --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>PAT:</label>
                                <input type="file" name="pat_certificate" id="" class="form-control" accept=".pdf" value="{{ old('pat_certificate') }}">
                                @error('pat_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="pat_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('pat_certificate_expiry_date') }}">
                                @error('pat_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of PAT --}}


                        {{-- Insurance --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Insurance:</label>
                                <input type="file" name="insurance_certificate" id="" class="form-control" accept=".pdf" value="{{ old('insurance_certificate') }}">
                                @error('insurance_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="insurance_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('insurance_certificate_expiry_date') }}">
                                @error('insurance_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of Insurance --}}

                        {{-- Lease or proof of ownership --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Proof of Ownership/Lease:</label>
                                <input type="file" name="ownership_certificate" id="" class="form-control" accept=".pdf" value="{{ old('ownership_certificate') }}">
                                @error('ownership_certificate')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Enter the document's expiry date:</label>
                                <input type="date" name="ownership_certificate_expiry_date" id="certificate" class="form-control" value="{{ old('ownership_certificate_expiry_date') }}">
                                @error('ownership_certificate_expiry_date')
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- End of lease or proof of ownership --}}
                        
                        {{-- Proof of Fire Blanket --}}
                        <input id="a-1" class="checkbox-custom" name="proof[]" value="Proof of File Blanket" type="checkbox">
                        <label for="a-1" class="checkbox-custom-label">Proof of Fire Blanket</label>
                        {{-- End for Proof of fire blanket --}}

                        {{-- Proof of CO Monitors --}}
                        <input id="a-2" class="checkbox-custom" name="proof[]" value="Proof of CO Monitors" type="checkbox">
                        <label for="a-2" class="checkbox-custom-label">Proof of CO Monitors</label>
                        {{-- End of Proof of CO Monitors --}}

                        {{-- Proof of Flame Retardant Spray --}}
                        <input id="a-3" class="checkbox-custom" name="proof[]" value="Proof of Flame Retardant Spray" type="checkbox">
                        <label for="a-3" class="checkbox-custom-label">Proof of Flame Retardant Spray</label>
                        {{-- End of Proof of Flame Retardant Spray --}}

                    </div>
                    
                    <div class="listing-submit-button">
                        @include('partials.listing-buttons')
                    </div>
                </form> 
            </div>
        </div>
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
        let expiry_date_fields = document.querySelectorAll("#certificate");
        expiry_date_fields.forEach(field => {
            field.setAttribute("min", today);
        });
    </script>
@endpush
</x-app-layout>