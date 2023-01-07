<?php

declare(strict_types=1);

namespace Wnull\Warface\Api;

use Http\Client\Exception;
use Wnull\Warface\Client;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;
use Wnull\Warface\HttpClient\Message\ResponseMediator;
use function count;
use function http_build_query;

abstract readonly class AbstractApi
{
    public function __construct(
        private Client $client
    ) {}

    /**
     * @throws InvalidJsonException|ApiException|Exception
     */
    protected function get(string $path, array $parameters = []): array
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, arg_separator: '&');
        }

        $response = $this->client->getHttpClient()->get($path);

        return ResponseMediator::getContent($response);
    }
}
