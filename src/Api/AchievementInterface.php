<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function catalog(): array;
}
