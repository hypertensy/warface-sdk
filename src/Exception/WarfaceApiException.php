<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\HttpClient\Message\ResponseMediator;
use Wnull\Warface\HttpClient\Message\ResponseMediatorInterface;

class WarfaceApiException extends Exception
{
    protected ResponseInterface $response;

    public function __construct(string $message, ResponseInterface $response, int $code = 0)
    {
        parent::__construct($message, $code);

        $this->response = $response;
    }

    public static function createFromResponse(string $message, ResponseInterface $response): self
    {
        return new static($message, $response, $response->getStatusCode());
    }

    public function getMediator(): ResponseMediatorInterface
    {
        return new ResponseMediator($this->response);
    }
}
