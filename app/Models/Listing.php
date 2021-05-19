<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'postcode', 'local_authority-area', 'description', 'living_rooms', 'toilets', 'bedsitting_rooms', 'bedrooms', 'bathrooms', 'kitchen', 'other_rooms', 'features', 'user_id', 'contact_name', 'contact_email', 'contact_number'
    ];

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

    /**
     * Get the clientgroup associated with the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clientgroup()
    {
        return $this->hasOne(ClientGroup::class);
    }
}
