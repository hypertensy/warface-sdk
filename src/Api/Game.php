<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Enum\EntityList;

class Game extends AbstractApi implements GameInterface
{
    public function missions(): array
    {
        return $this->getByMethod(__FUNCTION__);
    }

    protected function entity(): EntityList
    {
        return EntityList::GAME();
    }
}
