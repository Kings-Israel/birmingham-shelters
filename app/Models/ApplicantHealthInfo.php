<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantHealthInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'professional_officer', 'gp_name', 'gp_address', 'detained_for_mental_health', 'mental_health', 'physical_health', 'present_medication', 'current_cpa', 'other_relevant_information', 'has_criminal_offence', 'criminal_offence_details'
    ];

    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
