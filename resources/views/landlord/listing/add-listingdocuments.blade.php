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
                        @if ($errors->any())
                            {{ $errors }}
                        @endif
                        <h3>Property Documents</h3>
                        <p>Step 3 of 4</p>
                        <br>
                        <p>N.B: <strong>All documents should be in PDF format.</strong></p>
                        @for ($i = 0; $i < count($listing_documents); $i++)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{ $listing_documents[$i] }}:</label>
                                    <input type="file" name='listing_document[{{ $listing_documents[$i] }}]' id="{{ $listing_documents[$i] }}" class="form-control" accept=".pdf">
                                    @error('listing_document['.$listing_documents[$i].']')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Enter the {{ $listing_documents[$i] }}'s expiry date:</label>
                                    <input type="date" name="expiry_date[]" id="certificate" class="form-control" value="{{ old('expiry_date['.$i.']') }}">
                                    @error('expiry_date['.$i.']')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        @endfor
                        
                        @foreach ($proofs as $proof_id => $proof)
                            <input id="{{ $proof_id }}" class="checkbox-custom" name="proof[{{ $proof_id }}]" value="{{ $proof }}" type="checkbox">
                            <label for="{{ $proof_id }}" class="checkbox-custom-label">{{ $proof }}</label>
                        @endforeach

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