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
                <form action="javascript:void(0);" class="listing-form" method="post" enctype="multipart/form-data">
                    @csrf
                
                <div class="submit-page">
								
                    <!-- Basic Information -->
                    <div class="form-submit">	
                        <h3>Basic Information</h3>
                        
                        <div class="submit-section">
                            <div class="row">
                            
                                <div class="form-group col-md-12">
                                    <label>Property Title<span class="tip-topdata" data-tip="Property Title"><i class="ti-help"></i></span></label>
                                    <input type="text" id="name" name="name" class="form-control" >
                                    <span id="nameError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Service Charge</label>
                                    <input type="text" id="service_charge" class="form-control" name="service_charge" placeholder="GBP" >
                                    <span id="service_chargeError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Area (in square feet)</label>
                                    <input type="text" id="area" name="area" class="form-control">
                                    <span id="areaError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Bedrooms</label>
                                    <select id="bedrooms" id="bedrooms" name="bedrooms" class="form-control" >
                                        <option value="">&nbsp;</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <span id="bedroomsError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Bathrooms</label>
                                    <select id="bathrooms" id="bathrooms" name="bathrooms" class="form-control" >
                                        <option value="">&nbsp;</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <span id="bathroomsError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <div class="form-submit">	
                        <h3>Location</h3>
                        <div class="submit-section">
                            <div class="row">
                            
                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <input type="text" id="address" name="address" class="form-control" >
                                    <span id="addressError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" id="city" name="city" class="form-control" >
                                    <span id="cityError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input type="text" id="state" name="state" class="form-control" >
                                    <span id="stateError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Zip Code</label>
                                    <input type="text" id="zip_code" name="zip_code" class="form-control" >
                                    <span id="zip_codeError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detailed Information -->
                    <div class="form-submit">	
                        <h3>Detailed Information</h3>
                        <div class="submit-section">
                            <div class="row">
                            
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea class="form-control h-120" id="description" name="description" ></textarea>
                                    <span id="descriptionError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>Other Features (optional)</label>
                                    <div class="tag-container">
                                        <textarea class="form-control h-120" id="features" style="border: none" name="features"></textarea>
                                    </div>
                                    <span id="featuresError">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group col-lg-12 col-md-12">
                        <label>GDPR Agreement *</label>
                        <ul class="no-ul-list">
                            <li>
                                <input id="aj-1" id="agreement" class="checkbox-custom" name="aj-1" type="checkbox">
                                <label for="aj-1" class="checkbox-custom-label">I consent to having this website store my submitted information so they can respond to my inquiry.</label>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="form-group col-lg-12 col-md-12">
                        <button class="btn btn-theme-light-2 rounded" id="submit-listing" type="submit">Submit & Preview</button>
                    </div>
                </form>
                                
                </div>
            
        </div>
    </div>
</section>
<!-- ============================ Add Listing Form End ================================== -->
@push('scripts')
    <script>
        const tagContainer = document.querySelector('.tag-container');
        const input = document.querySelector('.tag-container textarea');
        const name = document.getElementById('name');
        const service_charge = document.getElementById('service_charge');
        const area = document.getElementById('area');
        const bedroom = document.getElementById('bedroom');
        const bathroom = document.getElementById('bathroom');
        const address = document.getElementById('address');
        const city = document.getElementById('city');
        const state = document.getElementById('state');
        const zip_code = document.getElementById('zip_code');
        const description = document.getElementById('description');
        const features = document.getElementById('features');
        let tags = [];

        function createTag(label) {
            const div = document.createElement('div');
            div.setAttribute('class', 'tag');
            const span = document.createElement('span');
            span.innerHTML = label;
            const closeIcon = document.createElement('i');
            closeIcon.innerHTML = 'close';
            closeIcon.setAttribute('class', 'material-icons');
            closeIcon.setAttribute('data-item', label);
            div.appendChild(span);
            div.appendChild(closeIcon);
            return div;
        }

        function clearTags() {
            document.querySelectorAll('.tag').forEach(tag => {
                tag.parentElement.removeChild(tag);
            });
        }

        function addTags() {
            clearTags();
            tags.slice().reverse().forEach(tag => {
                tagContainer.prepend(createTag(tag));
            });
        }

        input.addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
            e.target.value.split(',').forEach(tag => {
                tags.push(tag.slice(0, -1));
                features.innerHTML += tag.slice(0, -1);
            });
            
            addTags();
            input.value = '';
        }
    });
    document.addEventListener('click', (e) => {
        if (e.target.tagName === 'I') {
            const tagLabel = e.target.getAttribute('data-item');
            const index = tags.indexOf(tagLabel);
            tags = [...tags.slice(0, index), ...tags.slice(index+1)];
            addTags();    
        }
    })
    
    // input.focus();
    
    $('#submit-listing').on('click', (e) => {
        e.preventDefault();
        let formData = new FormData;
        formData.append('name', name.value)
        formData.append('service_charge', service_charge.value)
        formData.append('area', area.value)
        formData.append('bedrooms', bedrooms.value)
        formData.append('bathrooms', bathrooms.value)
        formData.append('address', address.value)
        formData.append('city', city.value)
        formData.append('state', state.value)
        formData.append('zip_code', zip_code.value)
        formData.append('description', description.value)
        formData.append('features', tags)
        $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('listing.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    window.location.assign(`/listing/${response.id}`);
                },
                error: (response) => {
                    if(response.status != 200) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function (key) {
                            $("#" + key + "Error").children("strong").text(errors[key][0]);
                        });
                    } else {
                        alert('There was an error. Please reload the page and try again')
                    }
                }
            })
        })
    </script>
@endpush
</x-app-layout>

