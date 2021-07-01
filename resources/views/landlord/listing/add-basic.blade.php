<x-app-dashboard-layout pageTitle="Property Basic Information">
    <form action="{{ route('listing.add.submit_basic_info') }}" class="listing-form" method="post" enctype="multipart/form-data">
        @csrf

        <div class="submit-page">

            <!-- Basic Information -->
            <div class="form-submit">
                <h3>Basic Information</h3>
                <p>Step 1 of 4</p>

                <div class="submit-section">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Property Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            <x-input-error for="name" />
                        </div>

                        <div class="form-group col-md-6">
                            <label>Address (e.g 308 Witton Road, Birmingham, UK)</label>
                            <input type="text" id="address" class="form-control" name="address" placeholder="" value="{{ old('address') }}" required>
                            <x-input-error for="address" />
                        </div>

                        <div class="form-group col-md-6">
                            <label>Postcode</label>
                            <input type="text" id="postcode" name="postcode" class="form-control" value="{{ old('postcode') }}" required>
                            <x-input-error for="postcode" />
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control h-120" id="description" name="description" required>{{ old('description') }}</textarea>
                            <x-input-error for="description" />
                        </div>
                        <div class="row">

                            <div class="form-group col-md-4">
                                <label>
                                    Living Rooms
                                    <input type="text" name="living_rooms" class="form-control" autocomplete="off" min="0" value="{{ old('living_rooms') }}" required>
                                </label>
                                <x-input-error for="living_rooms" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Bedrooms
                                    <input type="text" name="bedrooms" class="form-control" autocomplete="off" min="0" value="{{ old('bedrooms') }}" required>
                                </label>
                                <x-input-error for="bedrooms" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Bathrooms
                                    <input type="text" name="bathrooms" class="form-control" autocomplete="off" min="0" value="{{ old('bathrooms') }}" required>
                                </label>
                                <x-input-error for="bathrooms" />
                            </div>
                        </div>


                        <div class="row">

                            <div class="form-group col-md-4">
                                <label>
                                    Toilets
                                    <input type="text" name="toilets" class="form-control" autocomplete="off" min="0" value="{{ old('toilets') }}" required>
                                </label>
                                <x-input-error for="toilets" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Kitchens
                                    <input type="text" name="kitchen" class="form-control" autocomplete="off" min="0" value="{{ old('kitchen') }}" required>
                                </label>
                                <x-input-error for="kitchen" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>
                                    Available Rooms
                                    <input type="text" name="available_rooms" class="form-control" autocomplete="off" min="1" value="{{ old('available_rooms') }}" required>
                                </label>
                                <x-input-error for="available_rooms" />
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-md-12">
                        <label>Other Rooms (Enter each separated by a comma)<span class="tip-topdata" data-tip="E.g: Laundry Room, Home Office, e.t.c."><i class="ti-help"></i></span></label>
                        <input type="text" id="other_rooms" name="other_rooms" class="form-control" value="{{ old('other_rooms') }}">
                        <x-input-error for="other_rooms" />
                    </div>
                </div>
            </div>


            <div class="form-group col-md-12">
                <label>Features</label>
                <div class="o-features">
                    <ul class="no-ul-list third-row">
                        @php($selected_features = old("features", []))
                        @foreach ($features as $feature)
                            <li>
                                <input type="checkbox" class="checkbox-custom" name="features[]"
                                    id="a-{{$loop->index}}"
                                    value="{{ $feature }}"
                                    {{ in_array($feature, $selected_features) ? 'checked' : '' }}>
                                <label for="a-{{$loop->index}}" class="checkbox-custom-label text-capitalize">{{ $feature }}</label>
                            </li>
                        @endforeach
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
                            <x-input-error for="contact_name" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Email</label>
                            <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required>
                            <x-input-error for="contact_email" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}">
                            <x-input-error for="contact_number" />
                        </div>

                    </div>
                </div>
            </div>
            <div class="listing-submit-button">
                <div class="form-group col-lg-12 col-md-12" id="listing-buttons">
                    <a href="{{ route('listing.addition.cancel', $id ?? '') }}" class="btn btn-md btn-outline-theme">
                        Cancel
                    </a>
                    <button class="btn btn-theme-light-2 rounded" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</x-app-dashboard-layout>
