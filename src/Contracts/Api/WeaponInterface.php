<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;

interface WeaponInterface
{
    /**
     * This method returns a complete list of items available in the game, with their id and name.
     *
     * @throws Exception|JsonException
     */
    public function catalog(): array|string;
}
