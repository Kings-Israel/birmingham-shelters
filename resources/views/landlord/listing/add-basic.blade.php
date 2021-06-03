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
                <form action="{{ route('listing.add.submit_basic_info') }}" class="listing-form" method="post" enctype="multipart/form-data">
                    @csrf
                
                    <div class="submit-page">
                                    
                        <!-- Basic Information -->
                        <div class="form-submit">	
                            <h3>Basic Information</h3>
                            <p>Step 1 of 4</p>
                            
                            <div class="submit-section">
                                <div class="row">
                                
                                    <div class="form-group col-md-12">
                                        <label>Property Name<span class="tip-topdata" data-tip="Property Title"><i class="ti-help"></i></span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                                        @error('name')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <span id="nameError" class="invalid-feedback" role="alert">
                                    </span>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Address</label>
                                        <input type="text" id="address" class="form-control" name="address" placeholder="" value="{{ old('address') }}" required>
                                        @error('address')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Postcode</label>
                                        <input type="text" id="postcode" name="postcode" class="form-control" value="{{ old('postcode') }}" required>
                                        @error('postcode')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea class="form-control h-120" id="description" name="description" value="{{ old('description') }}" required></textarea>
                                        @error('description')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-4">
                                            <label>Living Rooms</label>
                                            <input type="number" id="living_rooms" name="living_rooms" class="form-control" min="0" required />
                                            @error('living_rooms')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Bedrooms</label>
                                            <input type="number" id="bedrooms" name="bedrooms" class="form-control" value="{{ old('bedrooms') }}" min="0" required />
                                            @error('bedrooms')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label>Bathrooms</label>
                                            <input type="number" id="bathrooms" name="bathrooms" class="form-control" value="{{ old('bathrooms') }}" min="0" required />
                                            @error('bathrooms')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="row">
        
                                        <div class="form-group col-md-4">
                                            <label>Toilets</label>
                                            <input type="number" id="toilets" name="toilets" class="form-control" value="{{ old('toilets') }}" min="0" required />
                                            @error('toilets')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Kitchen</label>
                                            <input type="number" id="kitchen" name="kitchen" class="form-control" value="{{ old('kitchen') }}" min="0" required>
                                            @error('kitchen')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Other Rooms (Enter each separated by a comma)<span class="tip-topdata" data-tip="E.g: Laundry Room, Home Office, e.t.c."><i class="ti-help"></i></span></label>
                                    <input type="text" id="other_rooms" name="other_rooms" class="form-control" value="{{ old('other_rooms') }}">
                                    @error('other_rooms')
                                        <strong class="error-message">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group col-md-12">
                            <label>Other Features</label>
                            <div class="o-features">
                                <ul class="no-ul-list third-row">
                                    <li>
                                        <input id="a-1" class="checkbox-custom" name="feature[]" value="Air Condition" type="checkbox">
                                        <label for="a-1" class="checkbox-custom-label">Air Condition</label>
                                    </li>
                                    <li>
                                        <input id="a-2" class="checkbox-custom" name="feature[]" value="Bedding" type="checkbox">
                                        <label for="a-2" class="checkbox-custom-label">Bedding</label>
                                    </li>
                                    <li>
                                        <input id="a-3" class="checkbox-custom" name="feature[]" value="Central Heating" type="checkbox">
                                        <label for="a-3" class="checkbox-custom-label">Central Heating</label>
                                    </li>
                                    <li>
                                        <input id="a-4" class="checkbox-custom" name="feature[]" value="Internet" type="checkbox">
                                        <label for="a-4" class="checkbox-custom-label">Internet</label>
                                    </li>
                                    <li>
                                        <input id="a-5" class="checkbox-custom" name="feature[]" value="Microwave" type="checkbox">
                                        <label for="a-5" class="checkbox-custom-label">Microwave</label>
                                    </li>
                                    <li>
                                        <input id="a-6" class="checkbox-custom" name="feature[]" value="Parking" type="checkbox">
                                        <label for="a-6" class="checkbox-custom-label">Parking</label>
                                    </li>
                                    <li>
                                        <input id="a-7" class="checkbox-custom" name="feature[]" value="Garden" type="checkbox">
                                        <label for="a-7" class="checkbox-custom-label">Garden</label>
                                    </li>
                                    <li>
                                        <input id="a-8" class="checkbox-custom" name="feature[]" value="Balcony" type="checkbox">
                                        <label for="a-8" class="checkbox-custom-label">Balcony</label>
                                    </li>
                                    <li>
                                        <input id="a-9" class="checkbox-custom" name="feature[]" value="Pre-Payment Meters" type="checkbox">
                                        <label for="a-9" class="checkbox-custom-label">Pre-Payment Meters</label>
                                    </li>
                                    <li>
                                </ul>
                            </div>
                        </div>

                        
                        <!-- Contact Information -->
                        <div class="form-submit">	
                            <h3>Contact Information</h3>
                            <div class="submit-section">
                                <div class="row">
                                
                                    <div class="form-group col-md-4">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required>
                                        @error('contact_name')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required>
                                        @error('contact_email')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="contact_phoneNumber" value="{{ old('contact_phoneNumber') }}">
                                        @error('contact_phoneNumber')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
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
        </div>
    </div>
</section>
</x-app-layout>