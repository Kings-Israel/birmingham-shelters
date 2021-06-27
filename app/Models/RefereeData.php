<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatusEnum;

class RefereeData extends Model
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
        'applicant_image',
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

    public function applicantsupportneeds()
    {
        return $this->hasOne(ApplicantSupportNeeds::class);
    }

    public function consent() 
    {
        return $this->hasOne(Consent::class);
    }

    public function coverImageUrl(): string
    {
        return $this->getImageUrl($this->images->first());
    }

    public function getImageUrl(string $filename): string
    {
        return Storage::disk('referee')->url('image/'.$filename);
    }

    public function canBook($user_id, $referee_data_id, $listing_id)
    {
        $booking_exists = Booking::where([
            ['user_id', '=', $user_id],
            ['referee_data_id', '=', $referee_data_id],
            ['listing_id', '=', $listing_id]
        ])->exists();

        $is_approved = Booking::where([
            ['referee_data_id', '=', $referee_data_id],
            ['status', '=', BookingStatusEnum::approved()->value]
        ])->exists();
            
        if($is_approved) {
            return false;
        } elseif($booking_exists) {
            return false;
        } else {
            return true;
        }
    }

    public function bookingStatus($user_id, $referee_data_id, $listing_id)
    {
        $status = Booking::where([
            ['user_id', '=', $user_id],
            ['referee_data_id', '=', $referee_data_id],
            ['listing_id', '=', $listing_id]
        ])->pluck('status')->first();
        
        return $status;
    }

    public function canApproveBooking($referee_data_id)
    {
        $bookingStatus = Booking::where([
            ['referee_data_id', $referee_data_id],
        ])->pluck('status');
        $bookingStatus = $bookingStatus->toArray();
        $status = array(BookingStatusEnum::approved()->label, BookingStatusEnum::awaiting_payment()->label);
        if(count(array_intersect($bookingStatus, $status)) > 0) {
            return false;
        }

        return true;
    }
    
}
