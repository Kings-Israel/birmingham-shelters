<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin-dashboard');
    }
}
