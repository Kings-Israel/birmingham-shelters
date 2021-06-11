<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantRiskAssessment extends Model
{
    use HasFactory;

    public function refereedata(): BelongsTo
    {
        return $this->belongsTo(RefereeData::class);
    }
}
