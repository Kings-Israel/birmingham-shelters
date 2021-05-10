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

                <ul class="nav-menu nav-menu-social align-to-right">
                    @guest
                    <li><a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</a></li>

                    <li class="add-listing">
                        <a href="{{ route('temp-salogin')}}">
                            <img src="/assets/img/user-light.svg" width="12" alt="" class="mr-2" />Sign In</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('temp-logout') }}"><img src="/assets/img/off.svg" class="mr-2" width="17"
                                alt="">Sign Out</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="clearfix"></div>
