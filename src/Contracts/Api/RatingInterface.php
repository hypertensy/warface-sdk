<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts\Api;

use Http\Client\Exception;
use JsonException;
use Wnull\Warface\Enum\GameClassEnum;
use Wnull\Warface\Enum\LeagueEnum;

interface RatingInterface
{
    /**
     * This method returns information about the rating of clans.
     *
     * @throws Exception|JsonException
     */
    public function clan(): array|string;

    /**
     * This method returns the monthly rating.
     *
     * If the $clan parameter is used, the response from the server will contain data about the selected clan, it will
     * also indicate exactly the league in which this clan is located even if it was not selected in the $league.
     *
     * If only the $league parameter is used, the server will return the top 100 for that league.
     *
     * @throws Exception|JsonException
     * @see LeagueEnum
     */
    public function monthly(?string $clan = null, LeagueEnum $league = LeagueEnum::NONE, int $page = 0): array|string;

    /**
     * This method returns a TOP-100 rating.
     *
     * If the parameter $class is not specified or set 0, the data gets for all classes.
     *
     * @throws Exception|JsonException
     * @see GameClassEnum
     */
    public function top100(GameClassEnum $class = GameClassEnum::NONE): array|string;
}
