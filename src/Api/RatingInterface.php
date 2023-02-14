<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Enum\GameClass;
use Wnull\WarfaceSdk\Enum\RatingLeague;
use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

interface RatingInterface
{
    /**
     * This method returns information about the rating of clans.
     *
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function clan(): array;

    /**
     * This method returns the monthly rating.
     *
     * If the $clan parameter is used, the response from the server will contain data about the selected clan, it will
     * also indicate exactly the league in which this clan is located even if it was not selected in the $league.
     *
     * If only the $league parameter is used, the server will return the top 100 for that league.
     *
     * @see LeagueEnum
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function monthly(?string $clan = null, RatingLeague $league = RatingLeague::NONE, int $page = 0): array;

    /**
     * This method returns a TOP-100 rating.
     *
     * If the parameter $class is not specified or set 0, the data gets for all classes.
     *
     * @see GameClassEnum
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    public function top100(GameClass $class = GameClass::NONE): array;
}
