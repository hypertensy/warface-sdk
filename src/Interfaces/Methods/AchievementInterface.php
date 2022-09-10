<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @return array
     */
    public function catalog(): array;
}
