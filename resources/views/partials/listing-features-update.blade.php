<!-- Log In Modal -->
<div class="modal fade signup" id="listing-features-update" tabindex="-1" role="dialog" aria-labelledby="listing-features-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h5 class="modal-header-title">Details and Features</h5>
                <div class="login-form">
                    <form method="POST" id="update-listing" action="{{ route('listing.update.basic_info') }}">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <div class="submit-section">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>Property Name<span class="tip-topdata" data-tip="Property Title"><i class="ti-help"></i></span></label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $listing->name }} {{ old('name') }}">
                                    <span id="nameError">
                                        <strong></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Address (e.g 308 Witton Road, Birmingham, UK)</label>
                                    <input type="text" id="address-input" class="form-control" name="address" placeholder="" value="{{ $listing->address }} {{ old('address') }}">
                                    <span id="addressError">
                                        <strong></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Postcode</label>
                                    <input type="text" id="postcode" name="postcode" class="form-control" value="{{ $listing->postcode }} {{ old('postcode') }}">
                                    <span id="postcodeError">
                                        <strong></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control h-120" id="description" name="description">{{ $listing->description }} {{ old('description') }}</textarea>
                                    <span id="descriptionError">
                                        <strong></strong>
                                    </span>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label>
                                            Living Rooms
                                            <input type="text" name="living_rooms" class="form-control" min="0" value="{{ $listing->living_rooms }} {{ old('living_rooms') }}">
                                        </label>
                                        <span id="living_roomsError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>
                                            Bedrooms
                                            <input type="text" name="bedrooms" class="form-control" min="0" value="{{ $listing->bedrooms }} {{ old('bedrooms') }}">
                                        </label>
                                        <span id="bedroomsError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>
                                            Bathrooms
                                            <input type="text" name="bathrooms" class="form-control" min="0" value="{{ $listing->bathrooms }} {{ old('bathrooms') }}">
                                        </label>
                                        <span id="bethroomsError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label>
                                            Toilets
                                            <input type="text" name="toilets" class="form-control" min="0" value="{{ $listing->toilets }} {{ old('toilets') }}">
                                        </label>
                                        <span id="toiletsError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>
                                            Kitchens
                                            <input type="text" name="kitchen" class="form-control" min="0" value="{{ $listing->kitchen }} {{ old('kitchen') }}">
                                        </label>
                                        <span id="kitchenError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>
                                            Available Rooms
                                            <input type="text" name="available_rooms" class="form-control" min="1" value="{{ $listing->available_rooms }} {{ old('available_rooms') }}">
                                        </label>
                                        <span id="available_roomsError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <label>Other Rooms (Enter each separated by a comma)<span class="tip-topdata" data-tip="E.g: Laundry Room, Home Office, e.t.c."><i class="ti-help"></i></span></label>
                                <input type="text" id="other_rooms" name="other_rooms" class="form-control" value="{{ $listing->other_rooms }} {{ old('other_rooms') }}">
                                <span id="other_roomsError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="submit-section">
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="contact_name" value="{{ $listing->contact_name }}{{ old('contact_name') }}" required>
                                    <span id="contact_nameError">
                                        <strong></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="contact_email" value="{{ $listing->contact_email }}{{ old('contact_email') }}" required>
                                    <span id="contact_emailError">
                                        <strong></strong>
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" id="contact_phone_number" name="contact_number" value="{{ $listing->contact_number }}{{ old('contact_number') }}">
                                    <span id="contact_numberError">
                                        <strong></strong>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" id="update-button" class="btn btn-md full-width btn-theme-light-2 rounded">Submit</button>
                        </div>

                    </form>
                    <h5 id="error-message" style="color: red; display: none">Invalid Credentials</h5>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    {{-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCisnVFSnc5QVfU2Jm2W3oRLqMDrKwOEoM&sensor=false&libraries=places"></script> --}}
    <script>
        $(function () {
            $('#other-types-checkbox').on('change', function () {
                const otherSupportTypesInput = $("#other_support_types");

                if(this.checked) {
                    otherSupportTypesInput.closest('.form-group').removeClass('d-none');
                } else {
                    otherSupportTypesInput.closest('.form-group').addClass('d-none');
                }
            })
        })

        $('#update-listing').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serializeArray();
            $("#update-button").attr('disabled', 'disabled')
            $("#update-button").text('Please Wait...')
            $.ajax({
                method: "POST",
                dataType: "json",
                headers: {
                    Accept: "application/json"
                },
                url: "{{ route('listing.update.basic_info') }}",
                data: formData,
                success: (response) => {
                    if(response == "success") {
                        window.location.reload()
                    }
                },
                error: (response) => {
                    if(response.status === 422) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                        });
                        $("#update-button").removeAttr('disabled')
                        $("#update-button").text('Sign Up')
                    } else {
                        window.location.reload();
                    }
                }
            })
        });

        let contact_phone_number = document.getElementById('contact_phone_number')

        contact_phone_number.addEventListener('focus', () => {
            contact_phone_number.value = '07'
        })
    </script>
    @endpush
</div>

<!-- End Modal -->
