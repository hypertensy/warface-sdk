<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Client;
use Warface\Interfaces\Methods\ClanInterface;

class Clan implements ClanInterface
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
     * @param string $clan
     * @return array
     */
    public function members(string $clan): array
    {
        return $this->controller->request('clan/members', [
            'clan' => $clan
        ]);
    }
}
