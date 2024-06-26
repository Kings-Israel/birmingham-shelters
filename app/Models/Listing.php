<?php

namespace App\Models;

use App\Models\Booking;
use App\Enums\BookingStatusEnum;
use App\Enums\ListingProofsEnum;
use App\Enums\ListingStatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Listing extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];

    protected $attributes = [
        'status' => 'draft',
        'proofs' => "[]",
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $casts = [
        'user_id' => 'integer',
        'status' => ListingStatusEnum::class,
        'is_available' => 'bool',
        'supported_groups' => 'array',
        // 'proofs' => ListingProofsEnum::class.':collection',
        'proofs' => 'array',
        'images' => AsCollection::class,
        'features' => 'collection',
    ];

    protected static function booted(): void
    {
        static::deleted(function(Listing $listing) {
            if($listing->images) {
                $listing->images
                    ->each(fn ($path) => Storage::disk('listing')->delete('images/'.$path));
            }
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

    public function inquiry(): HasMany
    {
        return $this->hasMany(ListingInquiry::class);
    }

    public function invoices(): MorphMany
    {
        return $this->morphMany(Invoice::class, 'invoiceable');
    }

    public function listingFeedback(): HasMany
    {
        return $this->hasMany(ListingFeedback::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getIsVerifiedAttribute(): bool
    {
        return $this->status === ListingStatusEnum::verified();
    }

    public function coverImageUrl(): string
    {
        $image = $this->images != null ? $this->images->first() : null;
        return $this->getImageUrl($image);
    }

    public function getImageUrl(?string $filename): string
    {
        $image = $filename != null ? $filename : 'no-image.jpg';
        return Storage::disk('listing')->url('images/'.$image);
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

        return tap($this, fn($instance) => $instance->status = ListingStatusEnum::verified());
    }

    public function isBooked($bookings)
    {
        foreach($bookings as $booking) {
            if($booking->status == BookingStatusEnum::approved()->value) {
                return true;
            }
        }

        return false;
    }

    public function setAssessmentDate($date): Listing
    {
        return tap($this, fn($instance) => $instance->assessment_date = $date);
    }
}
