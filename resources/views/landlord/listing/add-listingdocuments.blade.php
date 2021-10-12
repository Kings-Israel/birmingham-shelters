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
                                id="listing_documents.{{$type}}" >
                            <x-input-error for="listing_documents.{{$type}}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="expiry_dates.{{$type}}">{{ $label }} Expiry Date</label>
                            <input type="date" class="form-control" value="{{ old('expiry_date['.$type.']') }}"
                                name="expiry_dates[{{$type}}]" id="expiry_dates.{{$type}}" >
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
                <div class="form-group col-lg-12 col-md-12" id="listing-buttons">
                    <a href="{{ route('listing.addition.cancel', $id ?? '') }}" class="btn btn-md btn-outline-theme">
                        Cancel
                    </a>
                    <button class="btn btn-theme-light-2 rounded" type="submit">Submit</button>
                </div>
            </div>
    </form>
</x-app-dashboard-layout>
