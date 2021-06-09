<?php

namespace App\Models;

use App\Enums\ListingProofsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'verified_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'verified_at' => 'datetime',
        'is_available' => 'bool',
        'supported_groups' => 'array',
        'proofs' => ListingProofsEnum::class.':collection',
        'images' => 'collection',
        'features' => 'collection',
        'other_rooms' => 'collection',
    ];

    protected static function booted(): void
    {
        static::deleted(function(Listing $listing) {
            $listing->images
                ->each(fn ($path) => Storage::disk('listing')->delete('images/'.$path));
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

    public function getIsVerifiedAttribute(): bool
    {
        return isset($this->verified_at);
    }

    public function coverImageUrl(): string
    {
        return $this->getImageUrl($this->images->first());
    }

    public function getImageUrl(string $filename): string
    {
        return Storage::disk('listing')->url('images/'.$filename);
    }

    public function getProofs(): Collection
    {
        return collect(ListingProofsEnum::toArray())
            ->flatMap(function ($label, $value) {
                return [
                    $value => [
                        'label' => $label,
                        'value' => in_array(ListingProofsEnum::from($value), $this->proofs),
                    ]
                ];
            });
    }

    public function markAsVerified(): Listing
    {
        if ($this->is_verified) {
            return $this;
        }

        $this->verified_at = now();

        return $this;
    }
}
