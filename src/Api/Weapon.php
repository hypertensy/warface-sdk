<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\WeaponInterface;

readonly class Weapon extends AbstractApi implements WeaponInterface
{
    public function catalog(): array
    {
        return $this->get('weapon/catalog');
    }
}
