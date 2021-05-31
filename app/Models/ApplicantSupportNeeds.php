<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantSupportNeeds extends Model
{
    use HasFactory;

    /**
     * Get the usermetadata that owns the ApplicantSupportNeeds
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
