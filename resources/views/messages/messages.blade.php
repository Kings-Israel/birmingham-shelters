<x-app-dashboard-layout :pageTitle="$user->full_name">
    <section class="bg-title">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">

                    <div class="property_block_wrap style-4">
                        <div class="prt-detail-title-desc">
                            <h3 class="text-light">{{ $user->full_name }}</h3>
                            <span>{{ $user->email }}</span>
                            <p class="prt-price-fix"><strong id="listing_postcode">+{{ $user->phone_number }}</strong>
                            </p>
                        </div>
                    </div>

                </div>
                
            </div>
            
        </div>
    </section>
    <br>
    @if ($errors->any())
        {{ $errors }}
    @endif
    <div class="dashboard-wraper">
        @if (count($inquiries) <= 0)
            <span style="text-align: center">
                <h3>You do not have any messages.</h3>
            </span>
        @else
        <h4>My Messages</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>Listing Name</td>
                    <td>Message</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr class="booking-details-row">
                        <td>{{ $inquiry->listing->name }}</td>
                        <td><strong>{{ $inquiry->message_response }}</strong></td>
                        <td>
                            <form action="{{ route('listing.user.inquiry.delete', $inquiry->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-md btn-primary rounded m-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-dashboard-layout>