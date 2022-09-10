<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface ClanInterface
{
    /**
     * This method returns information about the clan.
     *
     * @param string $clan
     * @return array
     */
    public function members(string $clan): array;
}
