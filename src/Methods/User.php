<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Helpers\FullResponse;
use Warface\Interfaces\RequestInterface as Client;
use Warface\Interfaces\Methods\UserInterface;

class User implements UserInterface
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
     * @param string $name
     * @param int $formatFullResponse
     * @return array
     */
    public function stat(string $name, int $formatFullResponse = FullResponse::DEFAULT_TYPE): array
    {
        $get = $this->controller->request('user/stat', [
            'name' => $name
        ]);

        switch ($formatFullResponse) {
            case FullResponse::TO_ARRAY_TYPE:
                $get['full_response'] = FullResponse::format($get['full_response']);
                break;

            case FullResponse::REMOVE_TYPE:
                unset($get['full_response']);
                break;

            case FullResponse::DEFAULT_TYPE:
            default:
                break;
        }

        return $get;
    }

    /**
     * @param string $name
     * @return array
     */
    public function achievements(string $name): array
    {
        return $this->controller->request('user/achievements', [
            'name' => $name
        ]);
    }
}
