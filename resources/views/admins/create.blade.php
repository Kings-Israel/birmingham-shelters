<x-admin-layout>
    <x-page-title-with-action title="Create Admin Account" description="Provide admin personal details">
        <x-slot name="action">
            <a href="{{ route('admins.index') }}" class="btn btn-small btn-theme-2">Go back</a>
        </x-slot>
    </x-page-title-with-action>

    <section class="bg-light">
        @livewire('admin-account-form')
    </section>
</x-admin-layout>
