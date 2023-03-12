<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static RegionEnum CIS()
 * @method static RegionEnum INTERNATIONAL()
 */
class RegionEnum extends Enum
{
    public const CIS           = 'cis';
    public const INTERNATIONAL = 'international';
}
