<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="{{ route('admin-dashboard') }}" title="Sheltered Birmingham">
                    <p class="fw-bold fs-4 text-uppercase">SB</p>
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <x-nav-link :active="Route::is('admin-dashboard')">
                        <a href="{{ route('admin-dashboard') }}">Dashboard</a>
                    </x-nav-link>

                    <x-nav-link :active="Route::is('admins.index')">
                        <a href="#">User Management<span class="submenu-indicator"></span></a>

                        <ul class="nav-dropdown nav-submenu">
                            <x-nav-dropdown-link :active="Route::is('admins.index')" href="{{ route('admins.index') }}">Admins</x-nav-dropdown-link>
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Landlords</a></li>
                            <li><a href="#">Volunteers</a></li>
                        </ul>
                    </x-nav-link>
                </ul>

                <ul class="nav-menu align-to-right">
                    <li>
                        <a href="#"><i class="ti-user mr-1"></i>My Profile</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn text-dark" style="padding: 30px 12px; border: 0; font-family: 'Jost', sans-serif;">
                                <i class="ti-power-off mr-1"></i>Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="clearfix"></div>
