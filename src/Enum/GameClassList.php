<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

enum GameClassList: string
{
    case NONE     = '';
    case RIFLEMAN = 'Rifleman';
    case MEDIC    = 'Medic';
    case ENGINEER = 'Engineer';
    case SNIPER   = 'Recon';
    case SED      = 'Heavy';
}
