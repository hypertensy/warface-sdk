<?php

namespace Warface\Methods;

use Warface\RequestController;

class Rating
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
     * @param int $server
     * @param string|int $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(int $server, ?string $clan, int $league = 0, int $page = 0): array
    {
        return $this->class->request('rating/monthly', [
            'server' => $server,
            'clan' => $clan,
            'league' => $league,
            'page' => $page
        ]);
    }

    /**
     * @param int $server
     * @return array
     */
    public function clan(int $server): array
    {
        return $this->class->request('rating/clan', [
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
        return $this->class->request('rating/top100', [
            'server' => $server,
            'class' => $class
        ]);
    }
}