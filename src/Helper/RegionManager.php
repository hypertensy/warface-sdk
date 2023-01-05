<?php

declare(strict_types=1);

namespace Wnull\Warface\Helper;

use Wnull\Warface\Enum\Http\Region;

class RegionManager
{
    public static function getCisServer(): string
    {
        return static::resolve(Region::CIS);
    }

    public static function getInternationalServer(): string
    {
        return static::resolve(Region::INTERNATIONAL);
    }

    private static function resolve(Region $host): string
    {
        return 'https://' . $host->value . '/';
    }
}
