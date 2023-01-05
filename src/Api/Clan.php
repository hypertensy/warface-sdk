<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Http\Client\Exception;
use Wnull\Warface\Client;

readonly class Clan
{
    public function __construct(
        private Client $client
    ) {}


    /**
     * @throws Exception
     */
    public function members(): array
    {
        return $this->client->get('clan/members');
    }
}
