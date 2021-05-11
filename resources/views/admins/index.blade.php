<x-admin-layout pageTitle="Admins">
    <x-page-title-with-action title="Admin Accounts" description="A record of all admins in the system">
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

        <div class="py-5">
<<<<<<< HEAD
            <div class="bg-white container p-3 shadow-sm rounded-3">
=======
            <div class="bg-white container-lg p-3 shadow rounded-3">
                @if($admins->isEmpty())
                <p class="text-center fs-4 p-5">No admin account records found.
                    <a href="{{ route('admins.create') }}" class="text-decoration-underline">Create one now</a>
                </p>
                @else
>>>>>>> 2a64be2 (feat: delete admin account with confirmation modal)
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <th>{{ $admin->first_name }}</th>
                            <th>{{ $admin->last_name }}</th>
                            <th>{{ $admin->email }}</th>
                            <th>{{ $admin->phone_number }}</th>
                            <td>
                                <a href="{{ route('admins.edit', $admin->id) }}" class="btn py-0 btn-link" title="Edit admin account details">
                                    Edit
                                </a>
<<<<<<< HEAD
                                <a href="JavaScript:Void(0);" class="btn py-0 btn-link" title="Permanently delete account">
=======
                                <button
                                    data-user-id="{{ $admin->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete-user-confirmation-modal"
                                    class="btn py-0 btn-link"
                                    title="Permanently delete user account">
>>>>>>> 2a64be2 (feat: delete admin account with confirmation modal)
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @push('modals')
       @livewire('delete-user-modal', ['redirect_route_name' => "admins.index"])
    @endpush
</x-admin-layout>
