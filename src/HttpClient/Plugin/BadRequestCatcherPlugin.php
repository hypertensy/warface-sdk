<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\HttpClient\Plugin;

use Closure;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Wnull\WarfaceSdk\HttpClient\Exception\BadRequestException;

readonly class BadRequestCatcherPlugin implements Plugin
{
    protected const STATUS_BAD_REQUEST = 400;

    public function __construct(protected ?Closure $closure = null)
    {
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then($this->closure ?? $this->callback());
    }

    private function callback(): Closure
    {
        return static function (ResponseInterface $response): ResponseInterface {
            if ($response->getStatusCode() == self::STATUS_BAD_REQUEST) {
                throw new BadRequestException($response->getBody()->getContents(), $response->getStatusCode());
            }

            return $response;
        };
    }
}
