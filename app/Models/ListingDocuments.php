<?php

namespace App\Models;

use App\Enums\ListingDocumentTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingDocuments extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'document_type' => ListingDocumentTypesEnum::class,
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
