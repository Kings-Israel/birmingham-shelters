<x-admin-layout pageTitle="Admin Dashboard">
    <x-page-title :title="$greeting">
        <x-slot name="title">
            {{ $greeting }} {{ auth()->user()->full_name }}!
        </x-slot>
        <x-slot name="description">
            Welcome to your account.
        </x-slot>
    </x-page-title>

    <section class="bg-light">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="filter_search_opt">
                        <a href="javascript:void(0);" onclick="openFilterSearch()">Dashboard Navigation<i
                                class="ml-2 ti-menu"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- SideBar --}}
                <div class="col-lg-3 col-md-12">

                    <div class="simple-sidebar sm-sidebar" id="filter_search">

                        <div class="search-sidebar_header">
                            <h4 class="ssh_heading">Close Filter</h4>
                            <button onclick="closeFilterSearch()" class="w3-bar-item w3-button w3-large"><i
                                    class="ti-close"></i></button>
                        </div>

                        <div class="sidebar-widgets">
                            <div class="dashboard-navbar">

                                <div class="d-user-avater">
                                    <h4>{{ auth()->user()->full_name }}</h4>
                                    <span>{{ auth()->user()->email }}</span>
                                    <span>{{ auth()->user()->phone_number }}</span>
                                </div>

                                <div class="d-navigation">
                                    <ul>
                                        <li class="active"><a href="{{ route("admin-dashboard") }}"><i
                                                    class="ti-dashboard"></i>Dashboard</a></li>

                                        <li><a href="#"><i class="ti-user"></i>My Profile</a></li>

                                        <li><a href="{{ route('admins.index') }}"><i class="ti-user"></i>Administrators</a></li>

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="javascript:void(0);"
                                                    title="Sign Out"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="ti-power-off"></i>Sign Out
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                {{-- End SideBar --}}

                <div class="col-lg-9 col-md-12">
                    @include('partials.admin-dashboard-stats')
                </div>

            </div>
        </div>
    </section>

    <script>
        function openFilterSearch() {
            document.getElementById("filter_search").style.display = "block";
        }
        function closeFilterSearch() {
            document.getElementById("filter_search").style.display = "none";
        }
    </script>
</x-admin-layout>
