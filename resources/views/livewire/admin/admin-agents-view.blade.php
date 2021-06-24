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
                            <td>Number of Referees</td>
                            <td>Delete Agent</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agents as $agent)
                        <tr class="booking-details-row">
                            <td>{{ $agent->full_name }}</td>
                            <td><strong>{{ $agent->email }}</strong></td>
                            <td>{{ $agent->phone_number }}</td>
                            <td><strong>{{ $agent->created_at->format('d-m-Y') }}</strong></td>
                            <td>{{ count($agent->refereedata) }}</td>
                            <td>
                                <button wire:click="deleteUser({{ $agent }})" class="btn btn-primary btn-sm">
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
                {{ $agents->links() }}
            </div>
        </div>
    </div>
</div>
