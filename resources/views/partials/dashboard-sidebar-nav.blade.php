<nav>
    <x-nav-link href="{{ route('admin-dashboard') }}" :active="Route::is('admin-dashboard')">Dashboard</x-nav-link>
    <x-nav-link href="{{ route('admin.listings.index') }}" :active="Route::is('admin.listings.index')"> Listings</x-nav-link>
    <x-nav-link href="{{ route('admin.bookings.show') }}" :active="Route::is('admin.bookings.show')">Bookings</x-nav-link>
    <x-nav-link href="{{ route('admin.payments.show') }}" :active="Route::is('admin.payments.show')">Payments</x-nav-link>
    <x-nav-link href="{{ route('admin.messages.show') }}" :active="Route::is('admin.messages.show')">Messages</x-nav-link>

    <h3>User management</h3>
    @can('manageAdmins', App\Models\User::class)
    <x-nav-link href="{{ route('admins.index') }}" :active="Request::is('admin/admins*')"> Admins</x-nav-link>
    @endcan
    <x-nav-link href="{{ route('admin.landlords.show') }}" :active="Route::is('admin.landlords.show')">Landlords</x-nav-link>
    <x-nav-link href="{{ route('admin.agents.show') }}" :active="Route::is('admin.agents.show')">Agents</x-nav-link>
    <x-nav-link href="{{ route('admin.users.show') }}" :active="Route::is('admin.users.show')">Users</x-nav-link>

    <h3>Supporting Agencies</h3>
    <x-nav-link href="{{ route('admin.agencies.show') }}" :active="Route::is('admin.agencies.show')">View Agencies</x-nav-link>
</nav>
