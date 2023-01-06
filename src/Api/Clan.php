<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\ClanInterface;

readonly class Clan extends AbstractApi implements ClanInterface
{
    public function members(string $clan): array|string
    {
        return $this->get('clan/members', [
            'clan' => $clan,
        ]);
    }
}
