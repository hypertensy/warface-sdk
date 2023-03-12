<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Enum\EntityList;

use function compact;

class User extends AbstractApi implements UserInterface
{
    public function achievements(string $name): array
    {
        return $this->getByMethod(__FUNCTION__, compact('name'));
    }

    public function stat(string $name): array
    {
        return $this->getByMethod(__FUNCTION__, compact('name'));
    }

    protected function entity(): EntityList
    {
        return EntityList::USER();
    }
}
