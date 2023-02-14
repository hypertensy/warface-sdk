<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Enum;

enum GameClass: int
{
    case NONE     = 0;
    case RIFLEMAN = 1;
    case MEDIC    = 2;
    case ENGINEER = 3;
    case SNIPER   = 4;
    case SED      = 5;
}
