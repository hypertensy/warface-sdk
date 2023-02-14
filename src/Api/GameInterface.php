<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function missions(): array;
}
