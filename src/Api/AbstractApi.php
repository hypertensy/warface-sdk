<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Http\Client\Exception;
use JsonException;
use Wnull\Warface\Client;
use Wnull\Warface\HttpClient\Message\ResponseMediator;

use function count;
use function http_build_query;

abstract readonly class AbstractApi
{
    public function __construct(
        private Client $client
    ) {}

    /**
     * @throws Exception|JsonException
     */
    protected function get(string $path, array $parameters = []): array|string
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, arg_separator: '&');
        }

        $response = $this->client->getHttpClient()->get($path);

        return ResponseMediator::getContent($response);
    }
}
