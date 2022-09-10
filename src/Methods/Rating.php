<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Client;
use Warface\Enums\Classes\Enumeration;
use Warface\Enums\League;
use Warface\Interfaces\Methods\RatingInterface;

class Rating implements RatingInterface
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
     * @param string|null $clan
     * @param int $league
     * @param int $page
     * @return array
     */
    public function monthly(?string $clan = null, int $league = League::ELITE_LEAGUE, int $page = 0): array
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
    public function top100(int $class = Enumeration::NO_CLASS): array
    {
        return $this->controller->request('rating/top100', [
            'class'  => $class
        ]);
    }
}
