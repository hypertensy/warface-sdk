<?php

namespace Warface\Methods;

use Warface\RequestController;

class Game
{
    private RequestController $class;

    /**
     * User constructor.
     * @param RequestController $controller
     */
    public function __construct(RequestController $controller)
    {
        $this->class = $controller;
    }

    /**
     * @return array
     */
    public function missions(): array
    {
        return $this->class->request('game/missions');
    }
}