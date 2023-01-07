<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @throws InvalidJsonException|ApiException|Exception
     */
    public function missions(): array;
}
