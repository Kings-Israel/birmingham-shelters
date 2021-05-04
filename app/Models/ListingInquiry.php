<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingInquiry extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $casts = [
        'read_at' => 'datetime'
    ];
}
