<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminsManagementController extends Controller
{
    public function index()
    {
        $admins = User::admins()
            ->where('id', '!=', auth()->id())
            ->get();

        return view('admins.index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('admins.create');
    }

    public function edit(User $admin)
    {
        return view('admins.edit', ['admin' => $admin]);
    }
}
