<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Interfaces\RequestInterface as Client;
use Warface\Interfaces\Methods\GameInterface;

class Game implements GameInterface
{
    private Client $controller;

    /**
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return array
     */
    public function missions(): array
    {
        return $this->controller->request('game/missions');
    }
}
