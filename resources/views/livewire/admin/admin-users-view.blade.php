<div>
    <x-breadcrumb :items="$breadcrumb" />
    <div class="property_block_wrap style-2">
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td>Registration Date</td>
                            <td>Bookings Made</td>
                            <td>Delete User</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="booking-details-row">
                            <td>{{ $user->full_name }}</td>
                            <td><strong>{{ $user->email }}</strong></td>
                            <td>{{ $user->phone_number }}</td>
                            <td><strong>{{ $user->created_at->format('d-m-Y') }}</strong></td>
                            <td>{{ count($user->bookings) }}</td>
                            <td>
                                <button wire:click="deleteUser({{ $user }})" class="btn btn-primary btn-sm">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="row">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
