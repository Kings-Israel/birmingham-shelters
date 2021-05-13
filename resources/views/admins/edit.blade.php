<x-admin-layout>
    <x-page-title-with-action title="Edit Admin Account" description="Update admin personal details">
        <x-slot name="action">
            <a href="{{ route('admins.index') }}" class="btn btn-small btn-theme-2">Go back</a>
        </x-slot>
    </x-page-title-with-action>

    <section class="bg-light">
        @livewire('admin-account-form', ['admin' => $admin])
    </section>
</x-admin-layout>
