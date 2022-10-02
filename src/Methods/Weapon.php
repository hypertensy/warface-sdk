<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Interfaces\RequestInterface as Client;
use Warface\Interfaces\Methods\WeaponInterface;

class Weapon implements WeaponInterface
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
    public function catalog(): array
    {
        return $this->controller->request('weapon/catalog');
    }
}
