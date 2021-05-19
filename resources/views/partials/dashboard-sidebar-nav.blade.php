<nav>
    <x-nav-link href="{{ route('admin-dashboard') }}" :active="Route::is('admin-dashboard')">Dashboard</x-nav-link>
    <x-nav-link href="#">Listings</x-nav-link>
    <x-nav-link href="#">Bookings</x-nav-link>

    <h3>User management</h3>
    <x-nav-link href="{{ route('admins.index') }}" :active="Request::is('admin/admins*')"> Admins</x-nav-link>
    <x-nav-link href="#"> Landlords</x-nav-link>
    <x-nav-link href="#"> Volunteers</x-nav-link>
    <x-nav-link href="#"> Home Seekers</x-nav-link>
</nav>
