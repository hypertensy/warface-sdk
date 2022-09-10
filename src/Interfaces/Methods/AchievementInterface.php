<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface AchievementInterface
{
    /**
     * Gets a catalog of game achievements.
     *
     * @return array
     */
    public function catalog(): array;
}
