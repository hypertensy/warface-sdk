<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @throws Exception|JsonException
     */
    public function missions(): array|string;
}
