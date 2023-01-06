<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @throws Exception|JsonException
     */
    public function members(string $clan): array|string;
}
