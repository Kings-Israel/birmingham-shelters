<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id', 'image_name'
    ];

    public function url(): string
    {
        return Storage::disk('local')->url('listing/images/'.$this->image_name);
        // return Storage::disk('listing')->url('images/'.$this->image_name);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
