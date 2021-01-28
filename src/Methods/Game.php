<?php

namespace Warface\Methods;

use Warface\Client;

class Game
{
    private Client $controller;

    /**
     * User constructor.
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