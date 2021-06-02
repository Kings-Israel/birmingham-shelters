<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingInquiry extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $fillable = [
       'listing_id', 'user_name', 'user_email', 'user_phone_number', 'listing_message'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];
}
