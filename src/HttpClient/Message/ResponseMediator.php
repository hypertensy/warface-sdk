<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Message;

use JsonException;
use Psr\Http\Message\ResponseInterface;

use function json_decode;
use function json_last_error;
use function str_starts_with;

use const JSON_ERROR_NONE;
use const JSON_THROW_ON_ERROR;

final class ResponseMediator
{
    /**
     * @throws JsonException
     */
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = $response->getBody()->__toString();

        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            /** @var array<string|int, string|int> $content */
            $content = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            if (json_last_error() === JSON_ERROR_NONE) {
                return $content;
            }
        }

        return $body;
    }
}
