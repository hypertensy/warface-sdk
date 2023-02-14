<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

class Game extends AbstractApi implements GameInterface
{
    protected string $entity = 'game';

    public function missions(): array
    {
        return $this->get(__FUNCTION__);
    }
}
