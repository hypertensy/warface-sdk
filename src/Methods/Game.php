<?php

namespace Warface\Methods;

use Warface\Client;

class Game
{
    private Client $controller;

    /**
     * Game constructor.
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Gets extended information about the current PVE mission.
     * @return array
     */
    public function missions(): array
    {
        return $this->controller->request('game/missions');
    }
}