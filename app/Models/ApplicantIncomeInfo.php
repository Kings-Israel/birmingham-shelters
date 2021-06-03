<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantIncomeInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'source_of_income', 'dwp_office', 'other_debt'
    ];

    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
