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
                                        <label>Local Authority Area</label>
                                        <input type="text" id="local_authority_area" name="local_authority_area" class="form-control" value="{{ old('local_authority_area') }}" required>
                                        @error('local_authority_area')
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
                                            <select id="living_rooms" id="living_rooms" name="living_rooms" class="form-control" requireder>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('living_rooms')
                                            <strong class="error-message">{{ $message }}</strong>
                                        @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Bedsitting Rooms</label>
                                            <select id="bedsitting_rooms" id="bedsitting_rooms" name="bedsitting_rooms" class="form-control" value="{{ old('bedsitting_rooms') }}" required>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('bedsitting_rooms')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Bedrooms</label>
                                            <select id="bedrooms" id="bedrooms" name="bedrooms" class="form-control" value="{{ old('bedrooms') }}" required>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('bedrooms')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Bathrooms</label>
                                            <select id="bathrooms" id="bathrooms" name="bathrooms" class="form-control" value="{{ old('bathrooms') }}" required>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('bathrooms')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Toilets</label>
                                            <select id="toilets" id="toilets" name="toilets" class="form-control" value="{{ old('toilets') }}" required>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            @error('toilets')
                                                <strong class="error-message">{{ $message }}</strong>
                                            @enderror
                                        </div>
        
                                        <div class="form-group col-md-4">
                                            <label>Kitchen</label>
                                            <select id="kitchen" id="kitchen" name="kitchen" class="form-control" value="{{ old('kitchen') }}" required>
                                                <option value="">&nbsp;</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
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
                                        <label>Phone (optional)</label>
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