<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Message;

use JsonException;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

use const JSON_THROW_ON_ERROR;

final class ResponseMediator implements ResponseMediatorInterface
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return array<string|int, mixed>
     * @throws JsonException
     */
    public function getBodyContentsDecode(): array
    {
        $body = $this->getResponse()->getBody()->getContents();

        return (array)json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }
}
