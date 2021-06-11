<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantAddressInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'referee_data_id', 'address', 'moved_in', 'moved_out', 'tenure', 'landlord_details', 'reason_for_leaving'
    ];

    public function refereedata(): BelongsTo
    {
        return $this->belongsTo(RefereeData::class);
    }
}
