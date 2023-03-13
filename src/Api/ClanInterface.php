<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Exception\WarfaceApiException;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @return array<string|int, mixed>
     * @throws WarfaceApiException
     */
    public function members(string $clan): array;
}
