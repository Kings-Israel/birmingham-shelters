<ul>
    <x-app-sidebar-nav-link :active="Route::is('user.index')">
        <a href="{{ route('user.index') }}"><i class="ti-dashboard"></i>My Bookings</a>
    </x-app-sidebar-nav-link>
    <x-app-sidebar-nav-link :active="Route::is('profile.show')">
        <a href="{{ route('profile.show', auth()->user()) }}"><i class="ti-user"></i>My Profile</a>
    </x-app-sidebar-nav-link>
    <x-app-sidebar-nav-link :active="Route::is('messages.show')">
        <a href="{{ route('messages.show', auth()->user()) }}"><i class="ti-user"></i>My Messages</a>
    </x-app-sidebar-nav-link>
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="ti-power-off"></i>Log Out</a>
        </form>
    </li>
</ul>
