<x-admin-layout>
    <x-page-title title="Edit Admin Account" description="Update admin personal details" />

    <section class="bg-light">
        @livewire('admin-account-form', ['admin' => $admin])
    </section>
</x-admin-layout>
