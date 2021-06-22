<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self referral_fee()
 * @method static self sponsored_listing()
 */
final class InvoiceTypeEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'referral_fee' => 'Referral Fee',
            'sponsored_listing' => 'Sponsored Listing',
        ];
    }
}
