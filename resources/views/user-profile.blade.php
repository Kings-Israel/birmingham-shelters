<x-admin-layout pageTitle="My Profile">
    <x-page-title title="My Profile" description="View and update your details" />

    <section class="bg-light">
        <div class="container-lg mx-auto">
            <div class="d-grid gap-5">
                @livewire('personal-information-form')

                @livewire('change-password-form')
            </div>
        </div>
    </section>
</x-admin-layout>
