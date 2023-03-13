<?php

declare(strict_types=1);

namespace Wnull\Warface\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static EntityList ACHIEVEMENT()
 * @method static EntityList CLAN()
 * @method static EntityList GAME()
 * @method static EntityList RATING()
 * @method static EntityList USER()
 * @method static EntityList WEAPON()
 *
 * @extends Enum<string>
 */
final class EntityList extends Enum
{
    public const ACHIEVEMENT = 'achievement';
    public const CLAN        = 'clan';
    public const GAME        = 'game';
    public const RATING      = 'rating';
    public const USER        = 'user';
    public const WEAPON      = 'weapon';
}
