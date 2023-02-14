<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\Api;

use Http\Client\Exception as HttpClientException;
use Wnull\WarfaceSdk\Client;
use Wnull\WarfaceSdk\Exception\WarfaceSdkException;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;
use Wnull\WarfaceSdk\HttpClient\Message\ResponseMediator;

use function count;
use function http_build_query;

abstract class AbstractApi
{
    protected string $entity;

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * @throws WarfaceSdkException|InvalidApiResponseException
     */
    protected function get(string $method, array $parameters = []): array
    {
        $path = $this->entity . '/' . $method;

        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        try {
            $response = $this->client->getHttpClient()->get($path);
        } catch (HttpClientException $e) {
            throw new WarfaceSdkException($e->getMessage(), $e->getCode());
        }

        return ResponseMediator::getContent($response);
    }
}
