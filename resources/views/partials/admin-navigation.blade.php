<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="#">
                   <p class="fw-bold fs-4 text-uppercase">Sheltered Birmingham</p>
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
                    <li><a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</a></li>

                    <li class="add-listing">
                        <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><img
                                src="/assets/img/user-light.svg" width="12" alt="" class="mr-2" />Sign In</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="clearfix"></div>
