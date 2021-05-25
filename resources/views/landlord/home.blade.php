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

   <!-- ============================ User Dashboard ================================== -->
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
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4>Your Current Package: <span class="pc-title theme-cl">Gold Package</span></h4>
                    </div>
                </div>
                
                <div class="row">
        
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-1">
                            <div class="dashboard-stat-content"><h4>607</h4> <span>Listings Included</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                        </div>	
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-2">
                            <div class="dashboard-stat-content"><h4>102</h4> <span>Listings Remaining</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                        </div>	
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-3">
                            <div class="dashboard-stat-content"><h4>70</h4> <span>Featured Included</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-user"></i></div>
                        </div>	
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-4">
                            <div class="dashboard-stat-content"><h4>30</h4> <span>Featured Remaining</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                        </div>	
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-5">
                            <div class="dashboard-stat-content"><h4>Unlimited</h4> <span>Images / per listing</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                        </div>	
                    </div>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="dashboard-stat widget-6">
                            <div class="dashboard-stat-content"><h4>2021-02-26</h4> <span>Ends On</span></div>
                            <div class="dashboard-stat-icon"><i class="ti-user"></i></div>
                        </div>	
                    </div>

                </div>
        
                <div class="dashboard-wraper">
                
                    <!-- Basic Information -->
                    <div class="form-submit">	
                        <h4>My Account</h4>
                        <div class="submit-section">
                            <div class="row">
                            
                                <div class="form-group col-md-6">
                                    <label>Your Name</label>
                                    <input type="text" class="form-control" value="Shaurya Preet">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="preet77@gmail.com">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Your Title</label>
                                    <input type="text" class="form-control" value="Web Designer">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="123 456 5847">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="522, Arizona, Canada">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" value="Montquebe">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>State</label>
                                    <input type="text" class="form-control" value="Canada">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Zip</label>
                                    <input type="text" class="form-control" value="160052">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>About</label>
                                    <textarea class="form-control">Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper</textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            
        </div>
    </div>
</section>
<!-- ============================ User Dashboard End ================================== -->
@push('scripts')
    <script>
        Dropzone.options.statutoryDropzone = {
            // init: function(){
            //     this.on('complete', function(file) {
            //         location.reload();
            //     });
            // },
            acceptedFiles: ".doc, .docx, .pdf"
        };
        $(function () {
            $(".alert").delay(5000).slideUp(300);
        })
    </script>
@endpush
</x-app-layout>

