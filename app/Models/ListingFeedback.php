<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingFeedback extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_resolved' => 'bool',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function markAsResolved(): ListingFeedback
    {
        return tap($this, fn($instance) => $instance->is_resolved = true);

    }

}
