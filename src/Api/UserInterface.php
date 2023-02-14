<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

interface UserInterface
{
    /**
     * This method returns player statistics.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function stat(string $name): array;

    /**
     * This method returns player's achievements.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function achievements(string $name): array;
}
