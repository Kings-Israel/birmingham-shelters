<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'consent_name', 'consent_date', 'consent_company_position'
    ];

    /**
     * Get the usermetadata that owns the Consent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
