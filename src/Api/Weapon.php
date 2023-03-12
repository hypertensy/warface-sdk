<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Enum\EntityList;

class Weapon extends AbstractApi implements WeaponInterface
{
    public function catalog(): array
    {
        return $this->getByMethod(__FUNCTION__);
    }

    protected function entity(): EntityList
    {
        return EntityList::WEAPON();
    }
}
