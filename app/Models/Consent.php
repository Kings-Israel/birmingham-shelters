<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consent extends Model
{
    use HasFactory;

    protected $fillable = [
        'referee_data_id', 'consent_name', 'consent_date', 'consent_company_position'
    ];

    public function refereedata(): BelongsTo
    {
        return $this->belongsTo(RefereeData::class);
    }
}
