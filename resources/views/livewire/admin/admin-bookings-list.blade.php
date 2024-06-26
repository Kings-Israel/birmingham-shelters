<div>
    <x-breadcrumb :items="$breadcrumb" />
    <div class="property_block_wrap style-2">
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Referral Type</td>
                            <td>Listing</td>
                            <td>Status</td>
                            <td>Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr class="booking-details-row">
                            <td>{{ $booking->refereedata->applicant_name }}</td>
                            <td><strong>{{ $booking->refereedata->applicant_email }}</strong></td>
                            <td>{{ $booking->listing->name }}</td>
                            <td>{{ $booking->status }}</td>
                            <td> {{ $booking->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="row">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>
