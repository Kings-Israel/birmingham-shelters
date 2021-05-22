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
                
                <div class="submit-page">
								
                    <!-- Basic Information -->
                    <div class="form-submit">	
                        <h3>Property Images</h3>
                        <p>Step 4 of 4</p>
                        <div class="dashboard-wraper">
                            <h3>Upload Property Images Here:</h3>
                            <div class="submit-section">
                                <div class="row">
                                
                                    <div class="form-group col-md-12">
                                        <form action="{{ route('listing.add.submit_images') }}" method="POST" enctype="multipart/form-data" class="dropzone dz-clickable primary-dropzone" id="listing-dropzone">
                                            @csrf
                                            <input type="hidden" name="listing_id" value="{{ $id }}">
                                            <div class="dz-default dz-message">
                                                <i class="ti-files"></i>
                                                <span>Drag & Drop or Click to Select</span>
                                            </div>
                                            @error('file')
                                                <strong class="error-message"></strong>
                                            @enderror
                                        </form>
                                    </div>
                                    <div>
                                        <p class="file-upload-message" style="float: right"></p>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="{{ route('listing.view.all') }}" hidden class="redirect-home-button">
                        <button class="btn btn-theme-light-2 rounded" type="submit">Finish</button>
                    </a>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        Dropzone.options.listingDropzone = {
            init: function(){
                this.on('error', function(errorMessage) {
                    $('.file-upload-message').css('color', 'red');
                    $(".file-upload-message").text(errorMessage);
                });
                this.on('success', function(file, response) {
                    this.removeFile(file);
                    $('.file-upload-message').css('color', 'green');
                    $('.file-upload-message').text('File(s) Uploaded Successfully');
                    $('.redirect-home-button').removeAttr('hidden');
                });
            },
            acceptedFiles: ".png, .jpg, .jpeg"
        };
    </script>
@endpush
</x-app-layout>