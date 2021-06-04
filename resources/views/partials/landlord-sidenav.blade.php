<ul>
    <x-app-sidebar-nav-link :active="Route::is('landlord.index')">
        <a href="{{ route('landlord.index') }}"><i class="ti-dashboard"></i>Dashboard</a>
    </x-app-sidebar-nav-link>

    <x-app-sidebar-nav-link :active="Route::is('user-profile')">
        <a href="{{ route('user-profile') }}"><i class="ti-user"></i>My Profile</a>
    </x-app-sidebar-nav-link>

    <x-app-sidebar-nav-link :active="request()->routeIs('listing.view.*')">
        <a href="{{ route('listing.view.all') }}"><i class="ti-layers"></i>My Properties</a>
    </x-app-sidebar-nav-link>

    <x-app-sidebar-nav-link :active="request()->routeIs('listing.add.*')">
        <a href="{{ route('listing.add.basic_info') }}"><i class="ti-pencil-alt"></i>Submit New Property</a>
    </x-app-sidebar-nav-link>

    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="ti-power-off"></i>Log Out</a>
        </form>
    </li>
</ul>
