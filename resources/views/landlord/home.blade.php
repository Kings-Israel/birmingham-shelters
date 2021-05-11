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
                
                <div class="simple-sidebar sm-sidebar" id="filter_search">
                    
                    <div class="search-sidebar_header">
                        <h4 class="ssh_heading">Close Filter</h4>
                        <button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                    </div>
                    
                    <div class="sidebar-widgets">
                        <div class="dashboard-navbar">
                            
                            <div class="d-user-avater">
                                <img src="assets/img/user-3.jpg" class="img-fluid avater" alt="">
                                <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                            
                            <div class="d-navigation">
                                <ul>
                                    <li class="active"><a href="dashboard.html"><i class="ti-dashboard"></i>Dashboard</a></li>
                                    <li><a href="my-profile.html"><i class="ti-user"></i>My Profile</a></li>
                                    <li><a href="bookmark-list.html"><i class="ti-bookmark"></i>Bookmarked Listings</a></li>
                                    <li><a href="my-property.html"><i class="ti-layers"></i>My Properties</a></li>
                                    <li><a href="submit-property-dashboard.html"><i class="ti-pencil-alt"></i>Submit New Property</a></li>
                                    <li><a href="change-password.html"><i class="ti-unlock"></i>Change Password</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();"><i class="ti-power-off"></i>Log Out</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
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
                <br>
                <div class="dashboard-wraper">
                    <h3>Upload Statutory Documents</h3>
                    <div class="submit-section">
                        <div class="row">
                        
                            <div class="form-group col-md-12">
                                <form action="{{ route('statutory.store') }}" method="POST" enctype="multipart/form-data" class="dropzone dz-clickable primary-dropzone" id="statutory-dropzone">
                                    @csrf
                                    <div class="dz-default dz-message">
                                        <i class="ti-files"></i>
                                        <span>Drag & Drop or Click to Select</span>
                                    </div>
                                </form>
                            </div>                                
                        </div>
                    </div>
                </div>

                <br>
                @if (count(Auth::user()->document) > 0)
                    <div class="dashboard-wraper">
                        <h3>My Documents</h3>
                        <table class="table table-dark"> 
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->document as $document)
                                    <tr>
                                        <td>{{ $document->filename }}</td>
                                        <td>
                                            <form action="{{ route('statutory.delete', $document->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            
        </div>
    </div>
</section>
<!-- ============================ User Dashboard End ================================== -->
@push('scripts')
    <script>
        Dropzone.options.statutoryDropzone = {
            init: function(){
                this.on('complete', function(file) {
                    location.reload();
                });
            },
            acceptedFiles: ".doc, .docx, .pdf"
        };
        $(function () {
            $(".alert").delay(5000).slideUp(300);
        })
    </script>
@endpush
</x-app-layout>

