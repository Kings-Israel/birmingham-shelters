<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminsManagementController extends Controller
{
    public function all_admins()
    {
        $admins = User::admins()
            ->where('id', '!=', auth()->id())
            ->get();

        return view('admins.index', ['admins' => $admins]);
    }

    public function create_admin()
    {
        return view('admins.create');
    }

    public function edit_admin(User $admin)
    {
        return view('admins.edit', ['admin' => $admin]);
    }
}
