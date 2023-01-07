<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

interface UserInterface
{
    /**
     * This method returns player statistics.
     *
     * @throws InvalidJsonException|ApiException|Exception
     */
    public function stat(string $name): array;

    /**
     * This method returns player's achievements.
     *
     * @throws InvalidJsonException|ApiException|Exception
     */
    public function achievements(string $name): array;
}
