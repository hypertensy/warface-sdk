<?php

namespace Warface\Methods;

use Warface\{RequestController, Exceptions\RequestExceptions};

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
     * @throws RequestExceptions
     */
    public function missions(): array
    {
        return $this->class->request('game/missions');
    }
}