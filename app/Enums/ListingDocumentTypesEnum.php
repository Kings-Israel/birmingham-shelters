<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self gas_certificate()
 * @method static self electrical_certificate()
 * @method static self fire_and_smoke()
 * @method static self emergency_lighting()
 * @method static self fire_risk_assessment()
 * @method static self PAT()
 * @method static self insurance()
 * @method static self lease()
 */
final class ListingDocumentTypesEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'gas_certificate' => 'Gas Certificate',
            'electrical_certificate' => 'Electrical Certificate Report',
            'fire_and_smoke' => 'Fire Alarm/Smoke Detectors',
            'emergency_lighting' => 'Emergency Lighting',
            'fire_risk_assessment' => 'Fire Risk Assessment',
            'PAT' => 'PAT',
            'insurance' => 'Insurance',
            'lease' => 'Proof of Ownership/Lease',
        ];
    }
}
