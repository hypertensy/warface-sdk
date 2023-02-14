<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Enum;

enum RatingLeague: int
{
    case NONE     = 0;
    case ELITE    = 1;
    case PLATINUM = 2;
    case GOLDEN   = 3;
    case SILVER   = 4;
    case BRONZE   = 5;
    case STEEL    = 6;
}
