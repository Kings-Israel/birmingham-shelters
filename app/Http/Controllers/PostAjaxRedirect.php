<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Providers\RouteServiceProvider;

class PostAjaxRedirect extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // Method to redirect user to respective page after auth from ajax call
    public function ajaxRedirect(Request $request)
    {
        $role = Auth::user()->user_type;

        if ($role == 'user') {
            return redirect('/user/home');
        } elseif ($role == 'landlord') {
            return redirect('/landlord/home');
        } elseif($role == 'volunteer') {
            return redirect('/volunteer/home');
        }
    }
}
