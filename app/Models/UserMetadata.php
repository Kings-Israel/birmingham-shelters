<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'referral_type', 'referrer_name', 'referrer_phone_number', 'referrer_email', 'referral_reason', 'applicant_name', 'applicant_email', 'applicant_phone_number', 'applicant_date_of_birth', 'applicant_ni_number', 'applicant_current_address', 'applicant_gender', 'applicant_sexual_orientation', 'applicant_ethnicity', 'applicant_kin_name', 'applicant_kin_relationship', 'applicant_kin_phone_number', 'applicant_kin_email'
    ];

    /**
     * Get the user that owns the UserMetadata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
