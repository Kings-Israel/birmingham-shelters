<x-app-dashboard-layout pageTitle="Property Listing Documents">
    <form action="{{ route('listing.add.submit_documents') }}" class="listing-form" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="listing_id" value="{{ $id }}">
        <div class="submit-page">
            <!-- Basic Information -->
            <div class="form-submit">
                <h3>Property Documents</h3>
                <p>Step 3 of 4</p>
                @error('listing_documents')
                <div class="alert alert-danger alert-dismissible">
                    <p>{{ $message }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <div class="alert alert-info">
                    <p>All documents should be in PDF format.</p>
                </div>
                @foreach ($listing_document_types as $type => $label)
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listing_documents.{{$type}}">{{$label}}</label>
                        <input type="file" accept=".pdf" class="form-control" name="listing_documents[{{$type}}]"
                            id="listing_documents.{{$type}}" required>
                        <x-input-error for="listing_documents.{{$type}}" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expiry_dates.{{$type}}">Expiry Date</label>
                        <input type="date" class="form-control" value="{{ old('expiry_date['.$type.']') }}"
                            name="expiry_dates[{{$type}}]" id="expiry_dates.{{$type}}" required>
                        <x-input-error for="expiry_dates.{{$type}}" />
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
                @include('partials.listing-buttons')
            </div>
    </form>
    @push('scripts')
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        let expiry_date_fields = document.querySelectorAll("#certificate");
        expiry_date_fields.forEach(field => {
            field.setAttribute("min", today);
        });

    </script>
    @endpush
</x-app-dashboard-layout>
