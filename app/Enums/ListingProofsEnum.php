<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self fire_blanket()
 * @method static self co_monitors()
 * @method static self flame_retardant_spray()
 */
final class ListingProofsEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'fire_blanket' => 'Proof of Fire Blanket',
            'co_monitors' => 'Proof of CO Monitors',
            'flame_retardant_spray' => 'Proof of Flame Retardant Spray',
        ];
    }
}
