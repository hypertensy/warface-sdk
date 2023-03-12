<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Exception\WarfaceApiException;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @throws WarfaceApiException
     */
    public function missions(): array;
}
