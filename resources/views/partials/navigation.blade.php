<div class="header header-light head-shadow">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                @auth
                    @if (Auth::user()->user_type == 'user' || Auth::user()->user_type == 'agent')
                        <a class="nav-brand" href="{{ route('home') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="" />
                        </a>
                    @elseif (Auth::user()->user_type == 'landlord')
                        <a class="nav-brand" href="{{ route('landlord.index') }}">
                            <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="" />
                        </a>
                    @endif
                @endauth
                @guest
                    <a class="nav-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="" />
                    </a>
                @endguest
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    <x-site-nav-link :active="Request::is('/')">
                        @auth
                            @if (Auth::user()->user_type == 'user' || Auth::user()->user_type == 'agent')
                                <a href="{{ route('home') }}">Home</a>
                            @elseif (Auth::user()->user_type == 'landlord')
                                <a href="{{ route('landlord.index') }}">Home</a>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ url('/') }}">Home</a>
                        @endguest
                    </x-site-nav-link>
                    <x-site-nav-link :active="Request::is('about')">
                        <a href="{{ url('/about') }}">About Us</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('faq')">
                        <a href="{{ url('/faq') }}">FAQ</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('get-involved')">
                        <a href="{{ url('/get-involved') }}">Get Involved</a>
                    </x-site-nav-link>

                    <x-site-nav-link :active="Request::is('privacy')">
                        <a href="{{ url('/privacy') }}">Privacy & Data</a>
                    </x-site-nav-link>

                    @auth
                        @if (Auth::user()->isOfType('agent') || Auth::user()->isOfType('user'))
                            <x-site-nav-link :active="Request::is('listing/all')">
                                <a href="{{ route('listing.all') }}">View Listings</a>
                            </x-site-nav-link>
                        @endif
                    @else
                        <x-site-nav-link :active="Request::is('listing/all')">
                            <a href="{{ url('/listing/all') }}">View Listings</a>
                        </x-site-nav-link>
                    @endauth

                    <x-site-nav-link :active="Request::is('contact')">
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
                            @elseif (Auth::user()->user_type == 'agent')
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
