<?php

namespace App\Models;

use App\Enums\ListingProofsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'supported_groups' => 'array',
        'proofs' => 'array',
        'images' => 'collection',
        'features' => 'collection',
        'other_rooms' => 'collection',
    ];

    public function getIsVerifiedAttribute(): bool
    {
        return isset($this->verified_at);
    }

    public function coverImageUrl(): string
    {
        return $this->images->first()->url();
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

    public function documents(): HasMany
    {
        return $this->hasMany(ListingDocument::class);
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
}
