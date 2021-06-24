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
                            <td>Number of Listings</td>
                            <td>Delete Landlord</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($landlords as $landlord)
                        <tr class="booking-details-row">
                            <td>{{ $landlord->full_name }}</td>
                            <td><strong>{{ $landlord->email }}</strong></td>
                            <td>{{ $landlord->phone_number }}</td>
                            <td><strong>{{ $landlord->created_at->format('d-m-Y') }}</strong></td>
                            <td>{{ count($landlord->listings) }}</td>
                            <td>
                                <button wire:click="deleteUser({{ $landlord }})" class="btn btn-primary btn-sm">
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
                {{ $landlords->links() }}
            </div>
        </div>
    </div>
</div>
