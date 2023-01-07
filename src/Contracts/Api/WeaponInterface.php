<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

interface WeaponInterface
{
    /**
     * This method returns a complete list of items available in the game, with their id and name.
     *
     * @throws ApiException|InvalidJsonException
     */
    public function catalog(): array;
}
