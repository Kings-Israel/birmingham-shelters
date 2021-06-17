<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ListingInquiry extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $fillable = [
       'listing_id', 'user_name', 'user_email', 'user_phone_number', 'listing_message', 'message_response'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    /**
     * Get the listing that owns the ListingInquiry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function isRegistered(string $email): bool
    {
        if(User::where('email', '=', $email)->exists()) {
            return true;
        }

        return false;
    }
}
