<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Client;
use Warface\Interfaces\Methods\UserInterface;
use Warface\Utils\FullResponse;

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
     * @param int $format
     * @return array
     */
    public function stat(string $name, int $format = FullResponse::ABSENCE_MUTATION_FULL_FIELD): array
    {
        $get = $this->controller->request('user/stat', [
            'name' => $name
        ]);

        switch ($format) {
            case FullResponse::TO_ARRAY_RESPONSE_FULL_FIELD:
                $get['full_response'] = FullResponse::format($get['full_response']);
                break;

            case FullResponse::REMOVE_RESPONSE_FULL_FIELD:
                unset($get['full_response']);
                break;

            case FullResponse::ABSENCE_MUTATION_FULL_FIELD:
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
