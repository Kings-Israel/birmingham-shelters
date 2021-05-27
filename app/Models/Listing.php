<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'postcode', 'local_authority-area', 'description', 'living_rooms', 'toilets', 'bedsitting_rooms', 'bedrooms', 'bathrooms', 'kitchen', 'other_rooms', 'features', 'user_id', 'contact_name', 'contact_email', 'contact_number'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'is_available' => 'bool',
    ];

    public function getIsVerifiedAttribute(): bool
    {
        return isset($this->verified_at);
    }

    public function coverImageUrl(): string
    {
        return $this->listingimage->first()->url();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function listingimage(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function clientgroup(): HasOne
    {
        return $this->hasOne(ClientGroup::class);
    }

    public function documents(): HasOne
    {
        return $this->HasOne(ListingDocuments::class);
    }
}
