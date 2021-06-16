<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\RefereeData;
use App\Models\ApplicantAddressInfo;
use App\Models\ApplicantHealthInfo;
use App\Models\ApplicantIncomeInfo;
use App\Models\ApplicantSupportNeeds;
use App\Models\ApplicantRiskAssessment;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function user()
    {
        $bookings = Booking::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('user.index')->with('bookings', $bookings);
    }

    public function landlord()
    {
        $listings = Listing::where('user_id', '=', Auth::user()->id)->get();
        $total_listings = count($listings);
        $verified_listings = count($listings->where('verified_at', '!=', null));
        $occupied_listings = count($listings->where('is_available', '=', false));
        $unoccupied_listings = $total_listings - $occupied_listings;
        $bookings_total_number = 0;
        foreach ($listings->load('bookings') as $booking) {
            if(count($booking->bookings) != 0 ) {
                foreach($booking->bookings as $newBooking) {
                    $bookings_total_number++;
                }
            }
        }
        $listing_inquiries_total_number = 0;
        foreach ($listings->load('listinginquiry') as $inquiries) {
            if (count($inquiries->listinginquiry) != 0) {
                foreach($inquiries->listinginquiry as $inquiry) {
                    $listing_inquiries_total_number++;
                }
            }
        }
        return view('landlord.index')->with([
            'total_listings' => $total_listings,
            'verified_listings' => $verified_listings,
            'occupied_listings' => $occupied_listings,
            'unoccupied_listings' => $unoccupied_listings,
            'bookings_total_number' => $bookings_total_number,
            'listing_inquiries_total_number' => $listing_inquiries_total_number
        ]);
    }

    public function agent()
    {
        $bookings = Booking::where('user_id', '=', Auth::user()->id)->paginate(10);
        $referees = RefereeData::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('agent.index')->with(['bookings' => $bookings, 'referees' => $referees]);
    }

    public function agentReferees()
    {
        $referees = RefereeData::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('agent.my-referees')->with('referees', $referees);
    }

    public function referee(RefereeData $referee)
    {
        $applicant_addresses = ApplicantAddressInfo::where('referee_data_id', '=', $referee->id)->get();
        $applicant_health = ApplicantHealthInfo::where('referee_data_id', '=', $referee->id)->get();
        $applicant_support = ApplicantSupportNeeds::where('referee_data_id', '=', $referee->id)->get();
        $applicant_income = ApplicantIncomeInfo::where('referee_data_id', '=', $referee->id)->get();
        $applicant_risk_assessment = ApplicantRiskAssessment::where('referee_data_id', '=', $referee->id)->get();
        return view('referee.referee')->with([
            'referee' => $referee,
            'address_info' => $applicant_addresses,
            'health_info' => $applicant_health,
            'support_info' => $applicant_support,
            'income_info' => $applicant_income,
            'risk_assessment' => $applicant_risk_assessment
            ]);
    }

    public function showProfile(User $user)
    {
        return view('profile.profile')->with('user', $user);
    }

    public function updateProfile(Request $request)
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
