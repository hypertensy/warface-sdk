<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Http\Client\Exception;
use Wnull\Warface\Client;
use Wnull\Warface\Enum\League;
use Wnull\Warface\Enum\Player\Enumeration;

readonly class Rating
{
    public function __construct(
        private Client $client
    ) {}

    /**
     * @throws Exception
     */
    public function monthly(?string $clan = null, League $league = League::ELITE, int $page = 0): array
    {
        return $this->client->get('rating/monthly', [
            'clan'   => $clan,
            'league' => $league,
            'page'   => $page
        ]);
    }

    /**
     * @throws Exception
     */
    public function clan(): array
    {
        return $this->client->get('rating/clan');
    }

    /**
     * @throws Exception
     */
    public function top100(Enumeration $class = Enumeration::NULLABLE): array
    {
        return $this->client->get('rating/top100', [
            'class' => $class
        ]);
    }
}
