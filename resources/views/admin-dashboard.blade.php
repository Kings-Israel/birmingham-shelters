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
        <div class="container-lg mx-auto">
            @include('partials.admin-dashboard-stats')
            <div class="row">
                <div class="col-lg-9 col-md-12">
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
