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
                <form action="{{ route('listing.add.submit_client_info') }}" class="listing-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="listing_id" value="{{ $id }}">
                <div class="submit-page">
								
                    <!-- Basic Information -->
                    <div class="form-submit">	
                        <h3>Client Group and Support Details</h3>
                        <p>Step 2 of 4</p>
                        <br>
                        <p>N.B:<strong> All tenants must meet the definition of a vulnerable adult</strong></p>
                        
                        <div class="submit-section">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>What Client Group will you look to house here?</label>
                                    <div class="o-features">
                                        <ul class="no-ul-list">
                                            <li>
                                                <input id="a-1" class="checkbox-custom" name="client_group[]" type="checkbox" value="Mental Health">
                                                <label for="a-1" class="checkbox-custom-label">Mental Health</label>
                                            </li>
                                            <li>
                                                <input id="a-2" class="checkbox-custom" name="client_group[]" type="checkbox" value="Homeless">
                                                <label for="a-2" class="checkbox-custom-label">Homeless</label>
                                            </li>
                                            <li>
                                                <input id="a-3" class="checkbox-custom" name="client_group[]" type="checkbox" value="Drug Dependency">
                                                <label for="a-3" class="checkbox-custom-label">Drug Dependency</label>
                                            </li>
                                            <li>
                                                <input id="a-4" class="checkbox-custom" name="client_group[]" type="checkbox" value="Alcohol Dependency">
                                                <label for="a-4" class="checkbox-custom-label">Alcohol Dependency</label>
                                            </li>
                                            <li>
                                                <input id="a-5" class="checkbox-custom" name="client_group[]" type="checkbox" value="Learning Dependency">
                                                <label for="a-5" class="checkbox-custom-label">Learning Disability</label>
                                            </li>
                                            <li>
                                                <input id="a-6" class="checkbox-custom other_types_checkbox" name="client_group[]" type="checkbox" value="Other" onclick="var input = document.getElementById('other_support_types'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}">
                                                <label for="a-6" class="checkbox-custom-label">Other</label>
                                            </li>
                                        </ul>
                                    </div>
                                    @error('client_group')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Other (please specify)</label>
                                    <input type="text" id="other_support_types" name="other_support_types" class="form-control" disabled="disabled" value="{{ old('other_support_types') }}">
                                    @error('other_support_types')    
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Describe how support will be provided at the property</label>
                                    <textarea class="form-control h-120" id="support_description" name="support_description" required></textarea>
                                    @error('support_description')    
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group col-md-12">
                                <label>Total Support Hours Provided at the premises</label>
                                <input type="number" id="support_hours" name="support_hours" class="form-control" min="0" value="{{ old('support_hours') }}" required>
                                @error('support_hours')    
                                    <strong class="error-message">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
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
        $(function() {
            $('.other_types_checkbox').on('checked', function() {
                console.log('clicked')
                var formElementVisible = $(this).is(':checked');

                if(formElementVisible) {
                    $('#other_support_types').show()
                }

                $('#other_support_types').hide();
            })
        })
    </script>
@endpush
</x-app-layout>