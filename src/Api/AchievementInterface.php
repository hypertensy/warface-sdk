<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Exception\WarfaceApiException;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @throws WarfaceApiException
     */
    public function catalog(): array;
}
