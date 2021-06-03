<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.index');
    }

    public function user()
    {
        $user_details = User::with('usermetadata', 'bookings')->where('id', '=', Auth::user()->id)->get();
        return view('user.home')->with('user_details', $user_details);
    }

    public function landlord()
    {
        return view('landlord.home');
    }

    public function volunteer()
    {
        return view('volunteer.home');
    }
}
