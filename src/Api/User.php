<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use function compact;

class User extends AbstractApi implements UserInterface
{
    protected string $entity = 'user';

    public function stat(string $name): array
    {
        return $this->get(__FUNCTION__, compact('name'));
    }

    public function achievements(string $name): array
    {
        return $this->get(__FUNCTION__, compact('name'));
    }
}
