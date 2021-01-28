<?php

namespace Warface\Methods;

use Warface\Client;

class Rating
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
     * @param int $server
     * @param string $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(int $server, string $clan, int $league = 0, int $page = 0): array
    {
        return $this->controller->request('rating/monthly', [
            'server' => $server,
            'clan'   => $clan,
            'league' => $league,
            'page'   => $page
        ]);
    }

    /**
     * @param int $server
     * @return array
     */
    public function clan(int $server): array
    {
        return $this->controller->request('rating/clan', [
            'server' => $server,
        ]);
    }

    /**
     * @param int $server
     * @param int $class
     * @return array
     */
    public function top100(int $server, int $class = 0): array
    {
        return $this->controller->request('rating/top100', [
            'server' => $server,
            'class'  => $class
        ]);
    }
}