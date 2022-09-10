<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface WeaponInterface
{
    /**
     * This method returns a complete list of items available in the game, with their id and name.
     *
     * @return array
     */
    public function catalog(): array;
}
