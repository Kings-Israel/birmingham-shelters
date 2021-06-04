<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
}
