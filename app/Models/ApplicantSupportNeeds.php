<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantSupportNeeds extends Model
{
    use HasFactory;

    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
