<?php

namespace Warface\Methods;

use Warface\RequestController;

class Clan
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
     * @param string|int $clan
     * @param int $server
     * @return array
     */
    public function members(?string $clan, int $server): array
    {
        return $this->class->request('clan/members', [
            'clan' => $clan,
            'server' => $server
        ]);
    }
}