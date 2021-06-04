<?php

namespace App\Http\Controllers;


class PostAjaxRedirect extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function __invoke()
    {
        $user_type_home_map = [
            'super_admin' => route('admin-dashboard'),
            'admin' => route('admin-dashboard'),
            'landlord' => route('landlord.index'),
            'agent' => route('agent.index'),
        ];

        return redirect($user_type_home_map[auth()->user()->user_type->value] ?? '/');
    }
}
