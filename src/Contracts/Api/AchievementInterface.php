<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @throws Exception|JsonException
     */
    public function catalog(): array|string;
}
