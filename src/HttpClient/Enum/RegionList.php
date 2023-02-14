<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\HttpClient\Enum;

enum RegionList: string
{
    case CIS           = 'https://api.warface.ru/';
    case INTERNATIONAL = 'https://api.wf.my.com/';
}
