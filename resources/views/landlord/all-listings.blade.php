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
                                            <img src="https://via.placeholder.com/1200x800" class="img-fluid" alt="" />
                                        </div>
                                        <div class="sd-list-right">
                                            <h4 class="listing_dashboard_title"><a href="/listing/{{ $listing->id }}" class="theme-cl">{{ $listing->name }}</a></h4>
                                            <div class="user_dashboard_listed">
                                                Price: from ${{ $listing->service_charge }} month
                                            </div>
                                            <div class="user_dashboard_listed">
                                                Listed in <a href="javascript:void(0);" class="theme-cl">Rentals</a> and <a href="javascript:void(0);" class="theme-cl">Apartments</a>
                                            </div>
                                            <div class="user_dashboard_listed">
                                                City: <a href="javascript:void(0);" class="theme-cl">{{ $listing->city }}</a> , Area:{{ $listing->area }} sq ft
                                            </div>
                                            <div class="action">
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ti-pencil"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="202 User View"><i class="ti-eye"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Property" class="delete"><i class="ti-close"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Make Featured" class="delete"><i class="ti-star"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

