<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="/" title="Sheltered Birmingham">
                    <p class="fw-bold fs-4 text-uppercase">SB</p>
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <li class="active">
                        <a href="#">User Management<span class="submenu-indicator"></span></a>

                        <ul class="nav-dropdown nav-submenu">
                            <li><a class="active" href="{{ route('admins.index') }}">Admins</a></li>
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Landlords</a></li>
                            <li><a href="#">Volunteers</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-menu align-to-right">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn text-dark" style="padding: 30px 12px;">
                                <img src="{{ asset('/assets/img/off.svg') }}" class="mr-2" width="17"alt="">Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="clearfix"></div>
