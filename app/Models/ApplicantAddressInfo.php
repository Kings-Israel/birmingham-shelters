<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantAddressInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'address', 'moved_in', 'moved_out', 'tenure', 'landlord_details', 'reason_for_leaving'
    ];

    /**
     * Get the usermetadata that owns the ApplicantAddressInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}