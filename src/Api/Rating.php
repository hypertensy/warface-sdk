<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\RatingInterface;
use Wnull\Warface\Enum\GameClassEnum;
use Wnull\Warface\Enum\LeagueEnum;

readonly class Rating extends AbstractApi implements RatingInterface
{
    public function clan(): array
    {
        return $this->get('rating/clan');
    }

    public function monthly(?string $clan = null, LeagueEnum $league = LeagueEnum::NONE, int $page = 0): array
    {
        return $this->get('rating/monthly', [
            'clan'   => $clan,
            'league' => $league,
            'page'   => $page,
        ]);
    }

    public function top100(GameClassEnum $class = GameClassEnum::NONE): array
    {
        return $this->get('rating/top100', [
            'class' => $class,
        ]);
    }
}
