<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Exception\WarfaceApiException;

interface UserInterface
{
    /**
     * This method returns player statistics.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function stat(string $name): array;

    /**
     * This method returns player's achievements.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function achievements(string $name): array;
}
