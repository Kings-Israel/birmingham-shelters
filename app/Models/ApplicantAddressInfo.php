<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantAddressInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_metadata_id', 'address', 'moved_in', 'moved_out', 'tenure', 'landlord_details', 'reason_for_leaving'
    ];

    public function usermetadata(): BelongsTo
    {
        return $this->belongsTo(UserMetadata::class);
    }
}
