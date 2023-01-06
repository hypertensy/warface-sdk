<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum\Http;

enum RegionList: string
{
    case CIS           = 'api.warface.ru';
    case INTERNATIONAL = 'api.wf.my.com';
}
