<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum\Player;

enum Roster: string
{
    case NULLABLE = '';
    case RIFLEMAN = 'Rifleman';
    case MEDIC = 'Medic';
    case ENGINEER = 'Engineer';
    case SNIPER = 'Recon';
    case SED = 'Heavy';
}
