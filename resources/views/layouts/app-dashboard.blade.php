<x-app-layout :pageTitle="$pageTitle">
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible flash">
        <p>{{ session('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('success'))
    <div class="alert alert-success alert-dismissible flash">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

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
                                    <h4>{{ Auth::user()->full_name }}</h4>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>

                                <div class="d-navigation">
                                    @includeWhen(\Auth::user()->isOfType('landlord'), 'partials.landlord-sidenav')
                                    @includeWhen(\Auth::user()->isOfType('agent'), 'partials.agent-sidenav')
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    {{ $slot }}
                </div>
            </div>
    </section>
</x-app-layout>
