<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'consent_name', 'consent_date', 'consent_company_position'
    ];

    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
