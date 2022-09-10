<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface ClanInterface
{
    /**
     * Gets information about the members of the clan.
     *
     * @param string $clan
     * @return array
     */
    public function members(string $clan): array;
}
