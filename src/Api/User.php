<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\UserInterface;

readonly class User extends AbstractApi implements UserInterface
{
    public function stat(string $name): array
    {
        return $this->get('user/stat', [
            'name' => $name,
        ]);
    }

    public function achievements(string $name): array
    {
        return $this->get('user/achievements', [
            'name' => $name,
        ]);
    }
}
