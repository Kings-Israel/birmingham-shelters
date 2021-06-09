<?php

namespace App\Models;

use App\Enums\ListingDocumentTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ListingDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'document_type' => ListingDocumentTypesEnum::class,
        'expiry_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::deleted(function(ListingDocument $document) {
            Storage::disk('listing')->delete('documents/'.$document->filename);
        });
    }

    public function url(): string
    {
        return Storage::disk('listing')->url('documents/'.$this->filename);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
