<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

use Warface\Enums\Classes\Enumeration;
use Warface\Enums\League;

interface RatingInterface
{
    /**
     * Gets information about the monthly rating.
     *
     * @param string|null $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(?string $clan = null, int $league = League::ELITE_LEAGUE, int $page = 0): array;

    /**
     * Gets information about the rating of clans.
     *
     * @return array
     */
    public function clan(): array;

    /**
     * Gets information about the TOP-100 rating.
     *
     * @param int $class
     * @return array
     */
    public function top100(int $class = Enumeration::NO_CLASS): array;
}
