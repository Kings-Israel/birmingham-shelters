<x-app-dashboard-layout pageTitle="Property Images">
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
                            <form action="{{ route('listing.add.submit_images') }}" method="POST"
                                enctype="multipart/form-data" class="dropzone dz-clickable primary-dropzone"
                                id="listing-dropzone">
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
                        <div class="d-flex justify-content-end align-items-center">
                            <p class="file-upload-message"></p>
                            <div>
                                <a href="{{ route('listing.view.all') }}" hidden class="redirect-home-button">
                                    <button class="btn btn-theme-light-2 rounded" type="submit">Finish</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function finish(dropzoneInstance) {
            $('.redirect-home-button').prop('hidden', dropzoneInstance.files.length === 0);
        }

        Dropzone.options.listingDropzone = {
            addRemoveLinks: true,
            init: function () {

                this.on('error', function (file, message) {
                    $('.file-upload-message').css('color', 'red');
                    $(".file-upload-message").text(message);
                });

                this.on('success', (file, response) => finish(this) );

                this.on('removedfile', function (file) {

                    if (!file.accepted) return;

                    const { id } = JSON.parse(file.xhr.response);

                    $.ajax({
                        url: `${BASE_URL}/listing-images/${id}/delete`,
                        type: 'DELETE',
                        data: {
                            "_token": $("meta[name='csrf-token']").attr("content"),
                        }
                    }).then( ({ message }) => {
                        $('.file-upload-message').css('color', 'green').text(message);

                        const timeOutId = setTimeout(function(){
                            $('.file-upload-message').text('')
                            clearTimeout(timeOutId);
                        }, 4000);

                        finish(this);
                    });
                });
            },
            acceptedFiles: ".png, .jpg, .jpeg"
        };

    </script>
    @endpush
</x-app-dashboard-layout>
