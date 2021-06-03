<?php

namespace App\Models;

use App\Enums\ListingDocumentTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ListingDocuments extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'document_type' => ListingDocumentTypesEnum::class,
        'expiry_date' => 'date',
    ];

    public function url(): string
    {
        return Storage::disk('listing')->url('documents/'.$this->filename);
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
