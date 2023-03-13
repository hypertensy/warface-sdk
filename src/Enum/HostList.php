<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static HostList CIS()
 * @method static HostList INTERNATIONAL()
 *
 * @extends Enum<string>
 */
class HostList extends Enum
{
    public const CIS           = 'api.warface.ru';
    public const INTERNATIONAL = 'api.wf.my.com';
}
