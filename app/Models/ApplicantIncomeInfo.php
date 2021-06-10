<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantIncomeInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'referee_data_id', 'source_of_income', 'dwp_office', 'other_debt'
    ];

    public function refereedata(): BelongsTo
    {
        return $this->belongsTo(RefereeData::class);
    }

    public function getSourceOfIncomeListAttribute()
    {
        return collect(explode(',', $this->source_of_income));
    }
}
