<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\UserMetadata;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user()
    {
        $bookings = Booking::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('user.index')->with('bookings', $bookings);
    }

    public function landlord()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->get();
        $totalListings = count($listings);
        $verifiedListings = count($listings->where('verified_at', '!=', null));
        $occupiedListings = count($listings->where('is_available', '=', true));
        $unoccupiedListings = $totalListings - $occupiedListings;
        $bookings = [];
        foreach ($listings as $listing) {
            $bookings[$listing->id] = $listing->loadCount('bookings');
        }
        $listing_inquiries = [];
        foreach ($listings as $listing) {
            $listing_inquiries[$listing->id] = $listing->loadCount('listinginquiry');
        }
        // dd($listing_inquiries);
        return view('landlord.index');
    }

    public function agent()
    {
        return view('agent.index');
    }

    public function agent_referees()
    {
        $referees = UserMetadata::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('agent.my-referees')->with('referees', $referees);
    }

    public function show_profile(User $user)
    {
        return view('profile.profile')->with('user', $user);
    }

    public function update_profile(Request $request)
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => ['required', new PhoneNumber],
        ];

        $messages = [
            'required' => 'Please enter a value in this field',
            'email' => 'Please enter a valid email'
        ];
        
        Validator::make($request->all(), $rules, $messages)->validate();

        if($request->new_password != null) {
            if($request->old_password == null) {
                return redirect()->back()->withError('Please enter your current password');
            } elseif($request->new_password != $request->password_confirmation) {
                return redirect()->back()->withError("The passwords do not match");
            }

            if(!Hash::check($request->old_password, Auth::user()->password)) {
                return redirect()->back()->withError('The password you entered is not correct');
            }

        }
        $updateUser = User::find($request->user()->id);
        $updateUser->first_name = $request->first_name;
        $updateUser->last_name = $request->last_name;
        $updateUser->email = $request->email;
        $updateUser->phone_number = $request->phone_number;
        if($request->new_password != null) {
            $updateUser->password = Hash::make($request->new_password);
        }
        if($updateUser->save()) {
            return redirect()->back()->with('success', 'Your details have been updated');
        }

        return redirect()->back()->withError('There was a problem updating your information. Please try again');
    }
}
