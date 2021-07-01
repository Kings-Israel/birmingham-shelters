<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function enterEmail()
    {
        return view('auth.passwords.forgot-password');
    }

    public function confirmEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        return $status === Password::RESET_LINK_SENT
                    ? back()->with('success', $status)
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token)
    {
        return view('auth.passwords.reset')->with('token', $token);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

        $redirectUrl = '';

        if(Auth::user()->isOfType('landlord')){
            $redirectUrl = '/landlord';
        } elseif(Auth::user()->isOfType('agent')) {
            $redirectUrl = '/agent';
        } elseif(Auth::user()->isOfType('user')) {
            $redirectUrl = '/user';
        }
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->url($redirectUrl)->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
