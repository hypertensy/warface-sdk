<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Enum\EntityList;

use function compact;

class Clan extends AbstractApi implements ClanInterface
{
    public function members(string $clan): array
    {
        return $this->getByMethod(__FUNCTION__, compact('clan'));
    }

    protected function entity(): EntityList
    {
        return EntityList::CLAN();
    }
}
