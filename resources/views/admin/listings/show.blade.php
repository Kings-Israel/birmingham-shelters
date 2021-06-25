<x-admin-layout :pageTitle="$listing->name">
    <x-breadcrumb :items="$breadcrumb" />
    <!-- ============================ Property Header Info Start================================== -->
    <div class="bg-title">
        <div class="container px-4 py-3">
            @if($listing->is_available)
            <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-4">Available</span>
            @else
            <span class="badge rounded-pill fw-bold text-warning bg-light-warning m-l-4">Not Available</span>
            @endif
            <h3 class="text-light" id="listing_name">{{ $listing->name }}</h3>
            <div class="text-light fw-bold d-flex">
                <div hidden>
                    <h6>Address: </h6><span id="listing_address">{{ $listing->address }}</span><br>
                    <h6>Postcode: </h6><span id="listing_postcode">{{ $listing->postcode }}</span>
                </div>
                <span><i class="ti ti-pin m-r-5"></i> {{$listing->address}} ({{ $listing->postcode }})</span>
                <span class="m-l-15" title="Owner"><i class="ti ti-user m-r-5"></i>
                    {{ $listing->user->full_name }}</span>
            </div>
            <div class="m-t-10">
                <livewire:admin-verify-listing :listing="$listing" />
            </div>
        </div>
    </div>
    <!-- ============================ Property Header Info Start================================== -->

    <!-- ============================ Property Detail Start ================================== -->
    <section class="gray-simple">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <!-- Rooms and Features -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne"
                                aria-controls="clOne" href="javascript:void(0);" aria-expanded="false">
                                <h4 class="property_block_title">Rooms & Features</h4>
                            </a>
                        </div>
                        <div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne"
                            aria-expanded="true">
                            <div class="block-body">
                                <ul class="deatil_features">
                                    <li><strong>Living Rooms:</strong>{{ $listing->living_rooms }}</li>
                                    <li><strong>Available Rooms:</strong>{{ $listing->available_rooms }}</li>
                                    <li><strong>Occupied Rooms:</strong>{{ $listing->occupied_rooms }}</li>
                                    <li><strong>Bedrooms:</strong>{{ $listing->bedrooms }}</li>
                                    <li><strong>Bathrooms:</strong>{{ $listing->bathrooms }}</li>
                                    <li><strong>Toilets:</strong>{{ $listing->toilets }}</li>
                                    <li><strong>Kitchen:</strong>{{ $listing->kitchen }}</li>
                                </ul>
                                @if ($listing->other_rooms)
                                    <h6 class="property_block_title">Other Rooms:</h6>
                                    <p>{{ $listing->other_rooms }}</p>
                                @endif
                            </div>

                            @if($listing->features)
                            <div class="block-body">
                                <h6 class="property_block_title">Features</h6>
                                <ul class="avl-features third color">
                                    @foreach ($listing->features as $feature)
                                    <li class="text-capitalize">{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>

                    </div>

                    <!-- Description Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo"
                                aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true">
                                <h4 class="property_block_title">Description</h4>
                            </a>
                        </div>
                        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <p>{{ $listing->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Supported Client Groups Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#amen" data-bs-target="#clThree"
                                aria-controls="clThree" href="javascript:void(0);" aria-expanded="true">
                                <h4 class="property_block_title">Client Groups</h4>
                            </a>
                        </div>

                        <div id="clThree" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <ul class="avl-features third color">
                                    @foreach ($listing->supported_groups as $client)
                                    <li class="text-capitalize">{{ $client }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="block-body">
                                <h6 class="property_block_title">Client Support Description:</h6>
                                <p>{{ $listing->support_description }}</p>
                                <p class="property_block_title"><strong>Client Support Hours per week:</strong>
                                    {{ $listing->support_hours }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Location Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#loca" data-bs-target="#clSix"
                                aria-controls="clSix" href="javascript:void(0);" aria-expanded="true" class="collapsed">
                                <h4 class="property_block_title">Location</h4>
                            </a>
                        </div>

                        <div id="clSix" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <div class="hm-map-container fw-map" id="map-container">
                                    <div id="map"></div>
                                </div>
                                <div id="map-error" class="error-message">No Location data was provided.</div>
                            </div>
                        </div>

                    </div>

                    <!-- Gallery Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#clSev" data-bs-target="#clSev"
                                aria-controls="clOne" href="javascript:void(0);" aria-expanded="true" class="collapsed">
                                <h4 class="property_block_title">Gallery</h4>
                            </a>
                        </div>

                        <div id="clSev" class="panel-collapse collapse" aria-expanded="true">
                            <div class="block-body">
                                <ul class="list-gallery-inline">
                                    @foreach ($listing->images as $image)
                                    <li>
                                        <a href="{!! $listing->getImageUrl($image) !!}" class="mfp-gallery"><img
                                                src="{!! $listing->getImageUrl($image) !!}" class="img-fluid mx-auto"
                                                alt="" /></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#loca" data-bs-target="#clSix"
                                aria-controls="clSix" href="javascript:void(0);" aria-expanded="true" class="collapsed">
                                <h4 class="property_block_title">Documents & Proofs</h4>
                            </a>
                        </div>

                        <div id="clSix" class="panel-collapse collapse" aria-expanded="true">
                            <div class="block-body">
                                <ul class="list-unstyled">
                                    @foreach ($listing->getProofs() as $proof)
                                        <li>
                                            <i class="{{ $proof['value'] ? 'ti-check text-success' : 'ti-close text-danger' }}"></i>
                                                {{ $proof['label'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="block-body">
                                <ul class="list-unstyled w-75">
                                    @foreach ($listing->documents as $document)
                                    <li class="border px-4 py-2 d-flex justify-content-between align-items-center">
                                        <p>
                                            <span>{{ $document->document_type->label }}</span> <br>
                                            <small class="text-muted">EXPIRY:
                                                {{ $document->expiry_date->format('F d, Y') }}</small>
                                        </p>

                                        <livewire:admin-listing-document-actions :document="$document"
                                            :listing="$listing" />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                    <!-- Feedback Messages -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#cl-feedback" data-bs-target="#cl-feedback"
                                aria-controls="cl-feedback" href="javascript:void(0);" aria-expanded="true"
                                class="collapsed">
                                <h4 class="property_block_title">Feedback</h4>
                            </a>
                        </div>

                        <div id="cl-feedback" class="panel-collapse collapse show" aria-expanded="true">
                            <div class="block-body">
                                <livewire:listing-feedback-list :listing="$listing" />
                            </div>

                            <div class="block-body m-t-20">
                               <livewire:admin-submit-feedback :listing="$listing"/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Property Detail End ================================== -->

    @push('modals')
    @include('partials.preview-document-modal')
    @endpush
</x-admin-layout>
