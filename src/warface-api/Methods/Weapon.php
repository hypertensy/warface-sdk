<?php

namespace Warface\Methods;

use Warface\{RequestController, Exceptions\RequestExceptions};

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
     * @throws RequestExceptions
     */
    public function catalog(): array
    {
        return $this->class->request('weapon/catalog');
    }
}