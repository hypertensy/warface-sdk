<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface WeaponInterface
{
    /**
     * Gets the catalog of game weapons.
     *
     * @return array
     */
    public function catalog(): array;
}
