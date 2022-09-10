<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface GameInterface
{
    /**
     * Gets extended information about the current PVE mission.
     *
     * @return array
     */
    public function missions(): array;
}
