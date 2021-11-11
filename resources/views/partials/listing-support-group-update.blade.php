<!-- Log In Modal -->
<div class="modal fade signup" id="listing-support-group-update" tabindex="-1" role="dialog" aria-labelledby="listing-support-group-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h5 class="modal-header-title">Client Group Support</h5>
                <div class="login-form">
                    <form method="POST" id="update-listing-support-group" action="{{ route('listing.update.client_info') }}">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <div class="submit-section">
                            <div class="submit-section">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>What Client Group will you look to house here?</label>
                                        <div class="o-features">
                                            <ul class="no-ul-list">
                                                @php($old_supported_groups = old('supported_groups', []))

                                                @foreach ($supported_groups as $group)
                                                    <li>
                                                        <input type="checkbox" class="checkbox-custom" name="supported_groups[]"
                                                            value="{{ $group }}"
                                                            id="a-{{$loop->index}}"
                                                            {{ in_array($group, $old_supported_groups) ? 'checked' : '' }}>
                                                        <label for="a-{{$loop->index}}" class="checkbox-custom-label text-capitalize">{{ $group }}</label>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <input id="other-types-checkbox" class="checkbox-custom"
                                                        name="supported_groups[]" type="checkbox" value="Other"
                                                        {{ in_array('Other', $old_supported_groups) ? 'checked' : '' }}>
                                                    <label for="other-types-checkbox" class="checkbox-custom-label">Others</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <span id="supported_groupsError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-12 {{ !in_array('Other', $old_supported_groups) ? 'd-none' : '' }}">
                                        <label>Other (please specify)</label>
                                        <input type="text" id="other_support_types" name="other_supported_groups" class="form-control" value="{{ old('other_supported_groups') }}">
                                        <span id="other_supported_groupsError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>Describe how support will be provided at the property</label>
                                        <textarea class="form-control h-120" id="support_description" name="support_description">{{ $listing->support_description }}{{ old('support_description') }}</textarea>
                                        <span id="support_descriptionError">
                                            <strong></strong>
                                        </span>
                                    </div>

                                </div>

                                <div class="form-group col-md-12">
                                    <label>Total Support Hours Provided at the premises</label>
                                    <input type="text" id="support_hours" name="support_hours" class="form-control" min="0"
                                        value="{{ $listing->support_hours }}{{ old('support_hours') }}" required>
                                    <span id="support_hoursError">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" id="update-button" class="btn btn-md full-width btn-theme-light-2 rounded">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $('#update-listing-support-group').on('submit', function (e) {
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
                url: "{{ route('listing.update.client_info') }}",
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
                    } else {
                        // window.location.reload();
                    }
                }
            })
        });
    </script>
    @endpush
</div>

<!-- End Modal -->
