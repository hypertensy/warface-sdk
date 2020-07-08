<?php

namespace Warface\Methods;

use Warface\RequestController;

class Weapon
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
    public function catalog(): array
    {
        return $this->class->request('weapon/catalog');
    }
}