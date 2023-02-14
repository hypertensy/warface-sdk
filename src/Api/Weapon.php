<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

class Weapon extends AbstractApi implements WeaponInterface
{
    protected string $entity = 'weapon';

    public function catalog(): array
    {
        return $this->get(__FUNCTION__);
    }
}
