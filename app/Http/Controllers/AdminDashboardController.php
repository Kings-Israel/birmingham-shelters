<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Models\Payment;
use App\Models\Booking;
use App\Enums\BookingStatusEnum;
use App\Enums\ListingStatusEnum;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        $listings = Listing::all();
        $total_listings = count($listings);
        $verified_listings = count($listings->where('status', '=', ListingStatusEnum::verified()));
        $occupied_listings = count($listings->where('is_available', '=', false));
        $unoccupied_listings = $total_listings - $occupied_listings;
        $bookings_total_number = 0;
        foreach ($listings->load('bookings') as $booking) {
            if(count($booking->bookings) != 0 ) {
                foreach($booking->bookings as $newBooking) {
                    if($newBooking->status == BookingStatusEnum::pending()->label) {
                        $bookings_total_number++;
                    };
                }
            }
        }

        $users = User::where([
            ['user_type', '!=', 'admin'],
            ['user_type', '!=', 'super_admin']
        ])->get();
        $landlord_count = count($users->where('user_type', '=', 'landlord'));
        $agent_count = count($users->where('user_type', '=', 'agent'));
        $user_count = count($users->where('user_type', '=', 'user'));

        $amount_paid = 0;
        $payments = Payment::all();
        foreach ($payments as $payment) {
            $amount_paid += $payment->amount;
        }

        return view('admin-dashboard')->with([
            'total_listings' => $total_listings,
            'verified_listings' => $verified_listings,
            'occupied_listings' => $occupied_listings,
            'unoccupied_listings' => $unoccupied_listings,
            'bookings_total_number' => $bookings_total_number,
            'landlord_count' => $landlord_count,
            'agent_count' => $agent_count,
            'user_count' => $user_count,
            'amount_paid' => $amount_paid
        ]);
    }
}
