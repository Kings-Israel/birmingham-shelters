<?php

namespace App\Http\Controllers;

class AdminsManagementController extends Controller
{
    public function all_admins()
    {
        return view('admins.index');
    }

    public function create_admin()
    {
        return view('admins.create');
    }
}
