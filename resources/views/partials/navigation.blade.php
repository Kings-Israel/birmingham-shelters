<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="#">
                    <img src="{{ asset('img/sb-mock-logo.png') }}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <x-site-nav-link :active="Request::is('/')">
                        @auth
                            @if (Auth::user()->user_type == 'user')
                                <a href="{{ route('home') }}">Home</a>
                            @elseif (Auth::user()->user_type == 'landlord')
                                <a href="{{ route('landlord.index') }}">Home</a>
                            @elseif (Auth::user()->user_type == 'agent')
                                <a href="{{ route('home') }}">Home</a>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ url('/') }}">Home</a>
                        @endguest
                    </x-site-nav-link>
                    <x-site-nav-link :active="Request::is('/about')">
                        <a href="{{ url('/about') }}">About Us</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('/faq')">
                        <a href="{{ url('/faq') }}">FAQ</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('/get-involved')">
                        <a href="{{ url('/get-involved') }}">Get Involved</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('/privacy')">
                        <a href="{{ url('/privacy') }}">Privacy Policy</a>
                    </x-site-nav-link>

                    @guest
                        <x-site-nav-link :active="Request::is('/listing')">
                            <a href="{{ url('/listing/all') }}">View Listings</a>
                        </x-site-nav-link>
                    @endguest

                    @auth
                        @if (Auth::user()->isOfType('agent') || Auth::user()->isOfType('user'))
                            <x-site-nav-link :active="Request::is('/listing')">
                                <a href="{{ route('listing.all') }}">View Listings</a>
                            </x-site-nav-link>
                        @endif
                    @endauth

                    <x-site-nav-link :active="Request::is('/contact')">
                        <a href="{{ url('/contact') }}">Contact Us</a>
                    </x-site-nav-link>
                </ul>
                @auth
                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li><a> Welcome, {{ Auth::user()->full_name  }}</a>
                            @if (Auth::user()->user_type == 'user')
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a class="active" href="{{ route('user.index') }}">My Dashboard</a></li>
                                    @if (Auth::user()->isOfType('user') && !(Auth::user()->refereedata()->exists()))
                                    <li>
                                        <a href="{{ route('referral.self-referral') }}">Fill Referral Form</a>
                                    </li>
                                    @endif
                                </ul>
                            @endif
                            @if (Auth::user()->user_type == 'agent')
                                <ul class="nav-dropdown nav-submenu">
                                    <li><a class="active" href="{{ route('agent.index') }}">My Dashboard</a></li>
                                    @if(Auth::user()->isOfType('agent'))
                                    <li>
                                        <a href="{{ route('referral.agency-referral') }}">Fill Referral Form</a>
                                    </li>
                                    @endif
                                </ul>
                            @endif
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                @else
                    <ul class="nav-menu nav-menu-social align-to-right">
                        <li><a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</a></li>
                        <li class="add-listing">
                            <a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#login"><img
                                    src="{{ asset('assets/img/user-light.svg') }}" width="12" alt="" class="mr-2" />Sign In</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </nav>
    </div>
</div>

<div class="clearfix"></div>
