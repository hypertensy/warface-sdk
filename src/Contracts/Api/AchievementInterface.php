<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

interface AchievementInterface
{
    /**
     * This method returns a complete list of achievements available in the game, with their id and name.
     *
     * @throws InvalidJsonException|ApiException|Exception
     */
    public function catalog(): array;
}
