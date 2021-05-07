<x-admin-layout pageTitle="Admins">
    <x-page-title-with-action title="Admin Account" description="All admins in the system">
        <x-slot name="action">
            <a href="{{ route('admins.create') }}" class="btn btn-small btn-theme-2">Add New Admin</a>
        </x-slot>
    </x-page-title-with-action>

    <div class="bg-light">
        @if(session()->has('banner'))
        <div class="container-md pt-4">
            <x-banner :type="session('bannerStyle')">
                {{ session('banner') }}
            </x-banner>
        </div>
        @endif

        <section class="bg-white container">
            <div>
                <p>Insert datatable here</p>
            </div>
        </section>
    </div>

</x-admin-layout>
