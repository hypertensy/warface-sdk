<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static RatingLeague NONE()
 * @method static RatingLeague RIFLEMAN()
 * @method static RatingLeague MEDIC()
 * @method static RatingLeague ENGINEER()
 * @method static RatingLeague SNIPER()
 * @method static RatingLeague SED()
 */
final class GameClass extends Enum
{
    public const NONE     = 0;
    public const RIFLEMAN = 1;
    public const MEDIC    = 2;
    public const ENGINEER = 3;
    public const SNIPER   = 4;
    public const SED      = 5;
}
