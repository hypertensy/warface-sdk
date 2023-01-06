<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Wnull\Warface\Contracts\Api\GameInterface;

readonly class Game extends AbstractApi implements GameInterface
{
    public function missions(): array|string
    {
        return $this->get('game/missions');
    }
}
