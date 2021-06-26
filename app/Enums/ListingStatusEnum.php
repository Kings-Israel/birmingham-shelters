<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self draft()
 * @method static self pending()
 * @method static self verified()
 * @method static self needs_review()
 */
final class ListingStatusEnum extends Enum
{
    protected static function labels()
    {
        return [
            'draft' => 'Draft',
            'pending' => 'Pending',
            'verified' => 'Verified',
            'needs_review' => 'Needs Review'
        ];
    }
}
