<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if($pageTitle)
        {{ $pageTitle }} | {{ config('app.name') }}
        @else
        {{ config('app.name') }}
        @endif
    </title>

    <!-- Template Theme CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">

    @livewireStyles

    @stack('styles')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="blue-skin">
    <div id="preloader">
        <div class="preloader"><span></span><span></span></div>
    </div>

    <div id="dashboard-wrapper" class="bg-light" x-data="{ open: false}"  @keydown.escape="open=false">
        <!-- Off canvas mobile menu -->
        <div x-cloak x-show="open" class="mobile sidebar" role="dialog" aria-modal="true">
            <div x-show.transition.opacity="open" class="overlay" aria-hidden="true"></div>

            <div x-show.transition="open" @click.away="open=false" class="sidebar-content-wrapper">

                <div class="close-btn-wrapper">
                    <button @click="open=false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="heroicon-o-x" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <header class="d-flex align-items-center justify-content-center px-2">
                    <img src="{{ asset('img/sb-mock-logo.png') }}" alt="Sheltered Birmingham Logo">
                </header>

                <div class="sidebar-content">
                    @include('partials.dashboard-sidebar-nav')
                </div>
            </div>

            <div class="flex-shrink-0 w-14 dummy-element" aria-hidden="true">
                <!-- Dummy element to force sidebar to shrink to fit close icon -->
            </div>
        </div>
        <!-- END Off canvas mobile menu -->

        <!-- Static Desktop Sidebar -->
        <div class="desktop sidebar">
            <header class="d-flex align-items-center justify-content-center px-2">
                <img src="{{ asset('img/sb-mock-logo.png') }}" alt="Sheltered Birmingham Logo">
            </header>

            <div class="sidebar-content">
                @include('partials.dashboard-sidebar-nav')
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-column">
            <header class="shadow-sm">
                <button @click="open=true" class="btn-toggle-sidebar">
                    <span class="sr-only">Open Sidebar</span>
                    <svg class="heroicon-o-menu-alt-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>

                <div class="nav-menus-wrapper d-flex align-items-center justify-content-end">
                    <ul class="nav-menu">
                        <li class="{{ Route::is('user-profile') ? 'active' : '' }}">
                            <a href="{{ route('user-profile') }}"><i class="ti-user mr-1"></i>My Profile </a>
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
            </header>

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>


    @stack('modals')

    <!-- ==============================================================
        All Jquery
    ============================================================== -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/slider-bg.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @livewireScripts

    @stack('scripts')
</body>

</html>
