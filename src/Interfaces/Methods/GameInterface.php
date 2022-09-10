<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

interface GameInterface
{
    /**
     * This method returns detailed information about available missions and rewards for completing.
     *
     * @return array
     */
    public function missions(): array;
}
