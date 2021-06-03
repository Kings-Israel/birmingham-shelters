<x-app-dashboard-layout pageTitle="Property Client Group & Support Details">
    <form action="{{ route('listing.add.submit_client_info') }}" class="listing-form" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="listing_id" value="{{ $id }}">
        <div class="submit-page">

            <!-- Basic Information -->
            <div class="form-submit">
                <h3>Client Group and Support Details</h3>
                <p>Step 2 of 4</p>
                <div class="alert alert-info" role="alert">
                    <p>All tenants must meet the definition of a vulnerable adult</p>
                </div>

                <div class="submit-section">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>What Client Group will you look to house here?</label>
                            <div class="o-features">
                                <ul class="no-ul-list">
                                    @php($old_client_groups = old('client_group', []))

                                    @foreach ($client_groups as $group)
                                        <li>
                                            <input type="checkbox" class="checkbox-custom" name="client_group[]"
                                                value="{{ $group }}"
                                                id="a-{{$loop->index}}"
                                                {{ in_array($group, $old_client_groups) ? 'checked' : '' }}>
                                            <label for="a-{{$loop->index}}" class="checkbox-custom-label text-capitalize">{{ $group }}</label>
                                        </li>
                                    @endforeach
                                    <li>
                                        <input id="other-types-checkbox" class="checkbox-custom"
                                            name="client_group[]" type="checkbox" value="Other"
                                            {{ in_array('Other', $old_client_groups) ? 'checked' : '' }}>
                                        <label for="other-types-checkbox" class="checkbox-custom-label">Other</label>
                                    </li>
                                </ul>
                            </div>
                            <x-input-error for="client_group" />
                        </div>

                        <div class="form-group col-md-12 {{ !in_array('Other', $old_client_groups) ? 'd-none' : '' }}">
                            <label>Other (please specify)</label>
                            <input type="text" id="other_support_types" name="other_support_types" class="form-control" value="{{ old('other_support_types') }}">
                            <x-input-error for="other_support_types" />
                        </div>

                        <div class="form-group col-md-12">
                            <label>Describe how support will be provided at the property</label>
                            <textarea class="form-control h-120" id="support_description" name="support_description">{{ old('support_description') }}</textarea>
                            <x-input-error for="support_description" />
                        </div>

                    </div>

                    <div class="form-group col-md-12">
                        <label>Total Support Hours Provided at the premises</label>
                        <input type="number" id="support_hours" name="support_hours" class="form-control" min="0"
                            value="{{ old('support_hours') }}" required>
                        <x-input-error for="support_hours" />
                    </div>
                </div>
            </div>

            <div class="listing-submit-button">
                @include('partials.listing-buttons')
            </div>
    </form>

    @push('scripts')
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

    </script>
    @endpush
</x-app-dashboard-layout>
