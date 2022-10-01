<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

use Warface\Enums\Classes\Enumeration;
use Warface\Enums\League;

interface RatingInterface
{
    /**
     * This method returns the monthly rating.
     *
     * If the $clan parameter is used, the response from the server will contain data about the selected clan, it will
     * also indicate exactly the league in which this clan is located even if it was not selected in the $league.
     *
     * If only the $league parameter is used, the server will return the top 100 for that league.
     *
     * @see League
     * @param string|null $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(?string $clan = null, int $league = League::ELITE_LEAGUE, int $page = 0): array;

    /**
     * This method returns information about the rating of clans.
     *
     * @return array
     */
    public function clan(): array;

    /**
     * This method returns a TOP-100 rating.
     *
     * If the parameter $class is not specified, the data gets for all classes.
     *
     * @see Enumeration
     * @param int $class
     * @return array
     */
    public function top100(int $class = Enumeration::NO_CLASS): array;
}
