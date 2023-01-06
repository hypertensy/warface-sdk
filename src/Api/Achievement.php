<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\AchievementInterface;

readonly class Achievement extends AbstractApi implements AchievementInterface
{
    public function catalog(): array|string
    {
        return $this->get('achievement/catalog');
    }
}
