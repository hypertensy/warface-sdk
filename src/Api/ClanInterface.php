<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function members(string $clan): array;
}
