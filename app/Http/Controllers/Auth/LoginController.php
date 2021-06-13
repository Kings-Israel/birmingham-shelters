<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        $redirectPath = redirect()->intended($this->redirectPath())->getTargetUrl();

        return $request->wantsJson()
                    ? new JsonResponse(['redirectPath' => $redirectPath ], 200)
                    : redirect()->intended($this->redirectPath());
    }

    public function redirectTo(): string
    {
        $user_type_home_map = [
            'super_admin' => route('admin-dashboard'),
            'admin' => route('admin-dashboard'),
            'landlord' => route('landlord.index'),
            'agent' => route('agent.index'),
        ];

        return $user_type_home_map[Auth::user()->user_type->value] ?? '/';
    }


}
