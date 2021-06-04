<ul>
    <x-app-sidebar-nav-link :active="Route::is('agent.index')">
        <a href="{{ route('agent.index') }}"><i class="ti-dashboard"></i>Dashboard</a>
    </x-app-sidebar-nav-link>
    <x-app-sidebar-nav-link :active="Route::is('user-profile')">
        <a href="{{ route('user-profile') }}"><i class="ti-user"></i>My Profile</a>
    </x-app-sidebar-nav-link>
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="ti-power-off"></i>Log Out</a>
        </form>
    </li>
</ul>
