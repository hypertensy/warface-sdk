<?php

namespace Warface\Methods;

use Warface\Client;

class User
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
     * @param string $name
     * @param int $server
     * @param int $format
     * @return array
     */
    public function stat(string $name, int $server, int $format = 0): array
    {
        $get = $this->controller->request('user/stat', [
            'name'   => $name,
            'server' => $server
        ]);

        switch ($format) {
            case 1:
                unset($get['full_response']);
                break;
            case 2:
                // TODO: Implementation of parsing data from XML to ARRAY from the 'full_response' parameter
                break;
        }

        return $get;
    }

    /**
     * @param string $name
     * @param int $server
     * @return array
     */
    public function achievements(string $name, int $server): array
    {
        return $this->controller->request('user/achievements', [
            'name'   => $name,
            'server' => $server
        ]);
    }
}