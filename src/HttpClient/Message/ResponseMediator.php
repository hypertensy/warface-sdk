<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;
use Wnull\WarfaceSdk\HttpClient\Exception\InvalidApiResponseException;

use function json_decode;
use function str_starts_with;

class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array
    {
        if (!str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            throw new InvalidApiResponseException(
                'The received response came in the wrong format',
                $response->getStatusCode(),
            );
        }

        $content = $response->getBody()->getContents();

        if (empty($content)) {
            throw new InvalidApiResponseException('Invalid response from API', $response->getStatusCode());
        }

        return json_decode($content, true);
    }
}
