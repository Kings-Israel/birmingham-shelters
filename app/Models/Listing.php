<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the listingimage for the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listingimage()
    {
        return $this->hasMany(ListingImage::class);
    }
}
