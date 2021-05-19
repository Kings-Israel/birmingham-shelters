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
        
                <div class="dashboard-wraper">
                   <div class="form-submit">
                        @if (count($listings) <= 0)
                            <h4>Add Your Property to see them here</h4>
                        @else
                            <h4>My Property</h4>
                        @endif
                        <div class="row">
                            @foreach ($listings as $listing)
                                <!-- Single Property -->
                                <div class="col-md-12 col-sm-12 col-md-12">
                                    <div class="singles-dashboard-list">
                                        <div class="sd-list-left">
                                            <img src="/storage/listing/images/{{ $listing->listingimage[0]->image_name }}" class="img-fluid" alt="" />
                                        </div>
                                        <div class="sd-list-right">
                                            <h4 class="listing_dashboard_title"><a href="/listing/{{ $listing->id }}" class="theme-cl">{{ $listing->name }}</a></h4>
                                            <div class="user_dashboard_listed">
                                                Address: {{ $listing->address }}
                                            </div>
                                            <div class="user_dashboard_listed">
                                                Postcode: {{ $listing->postcode }}
                                            </div>
                                            <div class="user_dashboard_listed">
                                                Local Authority Area: {{ $listing->local_authority_area }}
                                            </div>
                                            <div class="action">
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ti-pencil"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="202 User View"><i class="ti-eye"></i></a>
                                                <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#delete_listing" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Property" class="delete"><i class="ti-close"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Featured" class="delete"><i class="ti-star"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Listing Form Modal -->
                                <div class="modal fade signup" id="delete_listing" tabindex="-1" role="dialog" aria-labelledby="sign-up" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                        <div class="modal-content" id="sign-up">
                                            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                                            <div class="modal-body">
                                                <h4 class="text-center">Are you Sure you Want to delete this listing?</h4>
                                                <div class="login-form">
                                                    <form method="POST" id="register-form" action="{{ route('listing.delete', $listing->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="form-group">
                                                            <button type="submit" id="register-button" class="btn btn-md full-width btn-primary rounded">Delete</button>
                                                        </div>

                                                    </form>
                                                    <button type="submit" id="register-button" data-bs-dismiss="modal" class="btn btn-md full-width btn-theme-light-2 rounded">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            @endforeach
                                
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
        
    </script>
@endpush
</x-app-layout>

