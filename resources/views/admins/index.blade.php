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
            <div class="bg-white container p-3 shadow-sm rounded-3">
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
                                <a href="JavaScript:Void(0);" class="btn py-0 btn-link" title="Permanently delete account">
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

</x-admin-layout>
