<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @throws InvalidJsonException|ApiException|Exception
     */
    public function members(string $clan): array;
}
