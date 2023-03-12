<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Enum\EntityList;
use Wnull\Warface\Enum\GameClass;
use Wnull\Warface\Enum\RatingLeague;

use function compact;

class Rating extends AbstractApi implements RatingInterface
{
    public function clan(): array
    {
        return $this->getByMethod(__FUNCTION__);
    }

    public function monthly(?string $clan = null, ?RatingLeague $league = null, int $page = 0): array
    {
        $league = ($league ?? RatingLeague::NONE())->getValue();

        return $this->getByMethod(__FUNCTION__, compact('clan', 'league', 'page'));
    }

    public function top100(?GameClass $class = null): array
    {
        $class = ($class ?? GameClass::NONE())->getValue();

        return $this->getByMethod(__FUNCTION__, compact('class'));
    }

    protected function entity(): EntityList
    {
        return EntityList::RATING();
    }
}
