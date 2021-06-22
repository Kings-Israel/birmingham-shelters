<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self pending()
 * @method static self approved()
 * @method static self awaiting_payment()
 * @method static self unsuccessful()
 */
final class BookingStatusEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'awaiting_payment' => 'Awaiting Payment',
            'unsuccessful' => 'Unsuccessful',
        ];
    }
}
