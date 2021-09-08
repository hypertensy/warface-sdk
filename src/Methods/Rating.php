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
     * @param string $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(string $clan, int $league = 0, int $page = 0): array
    {
        return $this->controller->request('rating/monthly', [
            'clan'   => $clan,
            'league' => $league,
            'page'   => $page
        ]);
    }

    /**
     * @return array
     */
    public function clan(): array
    {
        return $this->controller->request('rating/clan');
    }

    /**
     * @param int $class
     * @return array
     */
    public function top100(int $class = 0): array
    {
        return $this->controller->request('rating/top100', [
            'class'  => $class
        ]);
    }
}