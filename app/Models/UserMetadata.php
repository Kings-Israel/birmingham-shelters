<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'referral_type', 
        'referrer_name', 
        'referrer_phone_number', 
        'referrer_email', 
        'referral_reason', 
        'applicant_name', 
        'applicant_email', 
        'applicant_phone_number', 
        'applicant_date_of_birth', 
        'applicant_ni_number', 
        'applicant_current_address', 
        'applicant_gender', 
        'applicant_sexual_orientation', 
        'applicant_ethnicity', 
        'applicant_kin_name', 
        'applicant_kin_relationship', 
        'applicant_kin_phone_number', 
        'applicant_kin_email',
        'consent'
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
    
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function applicantaddressinfo()
    {
        return $this->hasOne(ApplicantAddressInfo::class);
    }

    public function applicanthealthinfo()
    {
        return $this->hasOne(ApplicantHealthInfo::class);
    }

    public function applicantincomeinfo()
    {
        return $this->hasOne(ApplicantIncomeInfo::class);
    }

    public function applicantriskassessment()
    {
        return $this->hasOne(ApplicantRiskAssessment::class);
    }

    public function applicantsupportneeeds()
    {
        return $this->hasOne(ApplicantSupportNeeds::class);
    }

    public function consent() 
    {
        return $this->hasOne(Consent::class);
    }
}
