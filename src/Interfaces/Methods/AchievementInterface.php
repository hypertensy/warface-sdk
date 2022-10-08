<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

use Warface\Methods\Achievement;

interface AchievementInterface
{
    public const CATALOG_DEFAULT_TYPE     = 0;
    public const CATALOG_ALTERNATIVE_TYPE = 1;

    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @see Achievement
     * @param int $variant
     * @return array
     */
    public function catalog(int $variant = AchievementInterface::CATALOG_DEFAULT_TYPE): array;
}
