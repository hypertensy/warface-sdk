<?php

namespace Warface\Methods;

use Warface\Client;

class Weapon
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
    public function catalog(): array
    {
        return $this->controller->request('weapon/catalog');
    }
}