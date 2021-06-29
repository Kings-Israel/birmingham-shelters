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
                            <td>Date</td>
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
                                <td>{{ $details->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('referees.referee', $details->id) }}">
                                        <button class="btn btn-sm btn-theme-light-2 rounded">View More</button>
                                    </a>
                                </td>
                                @if ($details->bookingStatus($details->user_id, $details->id, $listing_id) == "Unsuccessful")
                                <td>
                                    <a href="{{ url('/landlord/listing/booking/'.$details->user_id.'/'.$details->id.'/'.$listing_id.'/delete') }}">
                                        <button class="btn btn-md btn-primary rounded">Delete</button>
                                    </a>
                                </td>
                                @elseif ($details->bookingStatus($details->user_id, $details->id, $listing_id) == "Pending")
                                    @if ($details->canApproveBooking($details->id))
                                        <td>
                                            <form action="{{ route('listing.booking.check') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="referee_details" value="{{ $details }}">
                                                <input type="hidden" name="listing_id" value="{{ $listing_id }}">
                                                <button type="submit" class="btn btn-sm btn-theme-light-2 rounded">Approve</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ url('/landlord/listing/booking/'.$details->user_id.'/'.$details->id.'/'.$listing_id.'/delete') }}">
                                                <button class="btn btn-md btn-primary rounded">Delete</button>
                                            </a>
                                        </td>
                                    @endif
                                @elseif ($details->bookingStatus($details->user_id, $details->id, $listing_id) == "Approved")
                                    <td>
                                        <div>
                                            <i class="ti-check" style="font-size: 30px; color: rgb(10, 181, 115)"></i>
                                            <a style="float: right" href="{{ route('listing.referee.pdf', $details->id) }}">Download PDF</a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-dashboard-layout>