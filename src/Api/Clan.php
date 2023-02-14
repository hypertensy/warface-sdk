<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use function compact;

class Clan extends AbstractApi implements ClanInterface
{
    protected string $entity = 'clan';

    public function members(string $clan): array
    {
        return $this->get(__FUNCTION__, compact('clan'));
    }
}
