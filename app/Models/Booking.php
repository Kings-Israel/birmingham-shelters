<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'listing_id', 'user_id', 'referee_data_id', 'status',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];
    
    use HasFactory;

    /**
     * Get the user that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refereedata()
    {
        return $this->belongsTo(RefereeData::class, 'referee_data_id');
    }

    /**
     * Get the listing that owns the Booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function invoice()
    {
        return $this->morphOne(Invoice::class, 'invoiceable');
    }
}
