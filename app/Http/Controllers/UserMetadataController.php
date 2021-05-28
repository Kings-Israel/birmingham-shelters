<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserMetadataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_select_referral_type_form()
    {
        return view('user.referral.index');
    }

    public function self_referral()
    {
        return view('user.referral.self-referral');
    }

    public function agency_referral()
    {
        return view('user.referral.agency-referral');
    }

    public function add_income_info()
    {
        return view('user.referral.add-income-info');
    }

    public function add_address_history_info()
    {
        return view('user.referral.add-address-info');
    }
}
