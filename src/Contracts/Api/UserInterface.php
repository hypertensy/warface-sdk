<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;

interface UserInterface
{
    /**
     * This method returns player statistics.
     *
     * @throws Exception|JsonException
     */
    public function stat(string $name): array|string;

    /**
     * This method returns player's achievements.
     *
     * @throws Exception|JsonException
     */
    public function achievements(string $name): array|string;
}
