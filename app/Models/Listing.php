<?php

namespace App\Models;

use App\Enums\ListingProofsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

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

    public function getProofs(): Collection
    {
        return collect(ListingProofsEnum::toArray())
            ->flatMap(function ($label, $value) {
                return [
                    $value => [
                        'label' => $label,
                        'value' => $this->attributes[$value],
                    ]
                ];
            });
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

    public function documents(): HasMany
    {
        return $this->HasMany(ListingDocuments::class);
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
        if ($this->other_rooms != '' || null) {
            return collect(explode(',', $this->other_rooms));
        }
    }

    public function getFeaturesListAttribute()
    {
        return isset($this->features) ? collect(explode(',', $this->features)) : null;
    }
    
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
