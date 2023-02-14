<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Wnull\WarfaceSdk\Enum\GameClass;
use Wnull\WarfaceSdk\Enum\RatingLeague;

use function compact;

class Rating extends AbstractApi implements RatingInterface
{
    protected string $entity = 'rating';

    public function clan(): array
    {
        return $this->get(__FUNCTION__);
    }

    public function monthly(?string $clan = null, RatingLeague $league = RatingLeague::NONE, int $page = 0): array
    {
        $league = $league->value;

        return $this->get(__FUNCTION__, compact('clan', 'league', 'page'));
    }

    public function top100(GameClass $class = GameClass::NONE): array
    {
        $class = $class->value;

        return $this->get(__FUNCTION__, compact('class'));
    }
}
