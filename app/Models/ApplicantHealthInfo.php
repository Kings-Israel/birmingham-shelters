<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantHealthInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'referee_data_id', 'professional_officer', 'gp_name', 'gp_address', 'detained_for_mental_health', 'mental_health', 'physical_health', 'present_medication', 'current_cpa', 'other_relevant_information', 'has_criminal_offence', 'criminal_offence_details'
    ];

    protected $attributes = [
        'professional_officer' => 'Not Applicable',
        'gp_name' => 'Not Applicable',
        'gp_address' => 'Not Applicable',
        'detained_for_mental_health' => 'No',
        'mental_health' => 'Not Applicable',
        'physical_health' => 'Not Applicable',
        'present_medication' => 'Not Applicable',
        'current_cpa' => 'Not Applicable',
        'other_relevant_information' => 'Not Applicable',
        'has_criminal_offence' => 'No',
        'criminal_offence_details' => 'Not Applicable'
    ];

    public function refereedata(): BelongsTo
    {
        return $this->belongsTo(RefereeData::class);
    }
}
