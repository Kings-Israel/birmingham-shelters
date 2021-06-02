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
                    @include('partials.landlord-sidenav')
                </div>

                <div class="col-lg-9 col-md-12">
                    {{ $slot }}
                </div>
            </div>
    </section>
</x-app-layout>
