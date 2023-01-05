<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

use function json_decode;

final class ResponseMediator
{
    public static function getContent(ResponseInterface $response): array|bool
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
