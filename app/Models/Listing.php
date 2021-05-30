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
        'name', 'address', 'postcode', 'local_authority_area', 'description', 'living_rooms', 'toilets', 'bedsitting_rooms', 'bedrooms', 'bathrooms', 'kitchen', 'other_rooms', 'features', 'user_id', 'contact_name', 'contact_email', 'contact_number'
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

    public function listinginquiry(): HasMany
    {
        return $this->hasMany(ListingInquiry::class);
    }

    public function markAsVerified(): Listing
    {
        $this->verified_at = now();

        return $this;
    }

    public function getOtherRoomsListAttribute(): Collection
    {
        if($this->other_rooms != '' || null) {
            return collect(explode(',', $this->other_rooms));
        }
    }

    public function getFeaturesListAttribute(): Collection
    {
        if($this->features != '' || null) {
            return collect(explode(',', $this->features));
        }
    }
}
