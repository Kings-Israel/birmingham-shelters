<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'paypal_email',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime'
    ];
}
