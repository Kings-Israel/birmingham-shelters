<x-app-dashboard-layout pageTitle="Bookings">
    <div class="property_block_wrap style-2">

        <div class="property_block_wrap_header">
            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                href="javascript:void(0);" aria-expanded="true">
                <h4 class="property_block_title">
                    <a href="{{ route('listing.view.one', $listing_id) }}">
                        <i class="ti-angle-left"></i> 
                    </a>
                    Bookings:
                </h4>
            </a>
        </div>
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Referral Type</td>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($referee_data as $referee)
                        <tr class="booking-details-row">
                            @foreach ($referee as $details)
                                <td>{{ $details->applicant_name }}</td>
                                <td><strong>{{ $details->referral_type }}</strong></td>
                                <td>{{ $details->applicant_email }}</td>
                                <td>{{ $details->applicant_phone_number }}</td>
                                <td>
                                    <a href="{{ route('referees.referee', $details->id) }}">
                                        <button class="btn btn-sm btn-theme-light-2 rounded">View More</button>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-theme-light-2 rounded">Approve</button>
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>