<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (Auth::user()->isAdministrator()) {
            return route('admin-dashboard');
        }

        $role = Auth::user()->user_type;

        if ($role == 'user') {
            return RouteServiceProvider::USER_HOME;
        } elseif ($role == 'landlord') {
            return RouteServiceProvider::LANDLORD_HOME;
        } elseif($role == 'volunteer') {
            return RouteServiceProvider::VOLUNTEER_HOME;
        }
    }
}
