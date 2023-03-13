<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Plugin;

use Fig\Http\Message\StatusCodeInterface;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\Exception\ApiResponseErrorException;
use Wnull\Warface\Exception\BadRequestException;
use Wnull\Warface\Exception\InternalServerErrorException;
use Wnull\Warface\Exception\NotFoundException;
use Wnull\Warface\Exception\WarfaceApiException;

final class WarfaceClientExceptionPlugin implements Plugin
{
    /**
     * @throws WarfaceApiException
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(static function (ResponseInterface $response) {
            $status = $response->getStatusCode();
            switch ($status) {
                case StatusCodeInterface::STATUS_OK:
                    // Do nothing
                    break;
                case StatusCodeInterface::STATUS_BAD_REQUEST:
                    throw new BadRequestException($response->getBody()->__toString(), $status);
                case StatusCodeInterface::STATUS_NOT_FOUND:
                    throw new NotFoundException('Not Found', $status);
                case StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR:
                    throw new InternalServerErrorException('Internal Server Error', $status);
                default:
                    throw new ApiResponseErrorException('Unknown error from API', $status);
            }

            return $response;
        });
    }
}
