<x-app-dashboard-layout pageTitle="Dashboard">

    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-1">
                <div class="dashboard-stat-content">
                    <h4>{{ $total_listings }}</h4> <span>Listings Included</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-2">
                <div class="dashboard-stat-content">
                    <h4>{{ $occupied_listings }}</h4> <span>Listings Fully Occupied</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-star"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-3">
                <div class="dashboard-stat-content">
                    <h4>{{ $verified_listings }}</h4> <span>Verified Listings</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-check"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-4">
                <div class="dashboard-stat-content">
                    <h4>{{ $unoccupied_listings }}</h4> <span>Listings Unoccupied</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-bookmark-alt"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-5">
                <div class="dashboard-stat-content">
                    <h4>{{ $bookings_total_number }}</h4> <span>Bookings Made</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="dashboard-stat widget-6">
                <div class="dashboard-stat-content">
                    <h4>{{ $listing_inquiries_total_number }}</h4> <span>Inquiries On Listings</span>
                </div>
                <div class="dashboard-stat-icon"><i class="ti-help"></i></div>
            </div>
        </div>

    </div>
    
    <livewire:landlord-payments-view />

</x-app-dashboard-layout>
