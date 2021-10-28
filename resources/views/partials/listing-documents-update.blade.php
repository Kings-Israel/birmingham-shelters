<!-- Log In Modal -->
<div class="modal fade signup" id="listing-documents-update" tabindex="-1" role="dialog" aria-labelledby="listing-documents-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
        <div class="modal-content" id="sign-up">
            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
                <h5 class="modal-header-title">Documents <strong style="float: right">(Please upload all the documents)</strong></h5>
                <div class="login-form">
                    <form action="{{ route('listing.update.documents') }}" id="update-listing-documents" class="listing-form" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <input type="hidden" name="update" value="update">
                        <div class="submit-page">
                            <!-- Basic Information -->
                            <div class="form-submit">
                                @error('listing_documents')
                                <div class="alert alert-danger alert-dismissible">
                                    <p>{{ $message }}</p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                                @foreach ($listing_document_types as $type => $label)
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="listing_documents.{{$type}}">{{$label}}</label>
                                        <input type="file" accept=".pdf" class="form-control" name="listing_documents[{{$type}}]"
                                            id="listing_documents.{{$type}}">
                                            <span id="listing_documents.{{$type}}">
                                                <strong></strong>
                                            </span>
                                        {{-- <x-input-error for="listing_documents.{{$type}}" /> --}}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="expiry_dates.{{$type}}">Expiry Date</label>
                                        <input type="date" class="form-control" value="{{ old('expiry_date['.$type.']') }}"
                                            name="expiry_dates[{{$type}}]" id="expiry_dates.{{$type}}">
                                            <span id="expiry_dates.{{$type}}">
                                                <strong></strong>
                                            </span>
                                        {{-- <x-input-error for="expiry_dates.{{$type}}" /> --}}
                                    </div>
                                </div>
                                @endforeach

                                @php($old_proofs = array_keys(old('proof', [])))
                                @foreach ($proofs as $key => $label)
                                <input type="checkbox" class="checkbox-custom" id="proof-{{ $key }}" name="proof[{{ $key }}]"
                                    {{ in_array($key, $old_proofs) ? 'checked' : '' }}>
                                <label for="proof-{{ $key }}" class="checkbox-custom-label">{{ $label }}</label>
                                @endforeach

                            </div>

                            <div class="listing-submit-button">
                                <div class="form-group col-lg-12 col-md-12" id="listing-buttons">
                                    <button class="btn btn-theme-light-2 rounded" id="update-button" type="submit">Submit</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        // $('#update-listing-documents').on('submit', function (e) {
        //     e.preventDefault();
        //     let formData = $(this).serializeArray();
        //     $("#update-button").attr('disabled', 'disabled')
        //     $("#update-button").text('Please Wait...')
        //     $.ajax({
        //         method: "POST",
        //         dataType: "json",
        //         headers: {
        //             Accept: "application/json"
        //         },
        //         url: "{{ route('listing.add.submit_documents') }}",
        //         data: formData,
        //         success: (response) => {
        //             console.log(response)
        //             if(response == "success") {
        //                 window.location.reload()
        //             }
        //         },
        //         error: (response) => {
        //             console.log(response)
        //             if(response.status === 422) {
        //                 let errors = response.responseJSON.errors;
        //                 Object.keys(errors).forEach(function (key) {
        //                     $("#" + key + "Error").children("strong").text(errors[key][0]);
        //                 });
        //                 $("#update-button").removeAttr('disabled')
        //                 $("#update-button").text('Sign Up')
        //             } else {
        //                 window.location.reload();
        //             }
        //         }
        //     })
        // });
    </script>
    @endpush
</div>

<!-- End Modal -->
