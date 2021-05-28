<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\UserMetadata;

class ListingInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit_inquiry(Request $request)
    {
        // Check if user has metadata
        if (UserMetadata::where('user_id', $request->user_id)->exists()) {
            // Check if inquiry on listing from the user already exists
            dd($request->user_id);
        } else {
            dd('Doesn\'t exist');
        }
    }
}
