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
        return $next($request)->then(static function (ResponseInterface $response) use ($request) {
            switch ($response->getStatusCode()) {
                case StatusCodeInterface::STATUS_OK:
                    // Do nothing
                    break;
                case StatusCodeInterface::STATUS_BAD_REQUEST:
                    throw BadRequestException::createFromResponse('Bad Request', $response);
                case StatusCodeInterface::STATUS_NOT_FOUND:
                    throw NotFoundException::createFromResponse('Not Found', $response);
                case StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR:
                    throw InternalServerErrorException::createFromResponse('Internal Server Error', $response);
                default:
                    throw ApiResponseErrorException::createFromResponse('Unknown error from API', $response);
            }

            return $response;
        });
    }
}
