<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

class Achievement extends AbstractApi implements AchievementInterface
{
    protected string $entity = 'achievement';

    public function catalog(): array
    {
        return $this->get(__FUNCTION__);
    }
}
