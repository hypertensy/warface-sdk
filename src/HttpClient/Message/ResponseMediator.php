<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Message;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\Exception\Response\ApiException;
use Wnull\Warface\Exception\Response\InvalidJsonException;

use function json_decode;
use function json_last_error_msg;
use function sprintf;
use function str_starts_with;

use const JSON_THROW_ON_ERROR;

final class ResponseMediator
{
    /**
     * @throws ApiException|InvalidJsonException
     */
    public static function getContent(ResponseInterface $response): array
    {
        $body = $response->getBody()->__toString();

        if (!str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            throw new ApiException(sprintf('The response is not JSON: %s', $body));
        }

        try {
            /** @var array<string|int, mixed> $content */
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new InvalidJsonException(sprintf('Invalid JSON: %s', json_last_error_msg()));
        }
    }
}
