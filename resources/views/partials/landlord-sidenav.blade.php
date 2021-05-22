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
                    <li class="@if(request()->routeIs('landlord*')) active @else '' @endif"><a href="{{ route('landlord.index') }}"><i class="ti-dashboard"></i>Dashboard</a></li>
                    <li><a href="my-profile.html"><i class="ti-user"></i>My Profile</a></li>
                    <li><a href="bookmark-list.html"><i class="ti-bookmark"></i>Bookmarked Listings</a></li>
                    <li class="@if(request()->routeIs('listing.view.*')) active @else '' @endif"><a href="{{ route('listing.view.all') }}"><i class="ti-layers"></i>My Properties</a></li>
                    <li class="@if(request()->routeIs('listing.add.*')) active @else '' @endif"><a href="{{ route('listing.add.basic_info') }}"><i class="ti-pencil-alt"></i>Submit New Property</a></li>
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