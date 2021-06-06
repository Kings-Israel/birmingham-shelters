<?php

namespace App\Http\Controllers;
use App\Models\User;
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
        return view('user.index');
    }

    public function landlord()
    {
        return view('landlord.index');
    }

    public function agent()
    {
        return view('agent.index');
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
