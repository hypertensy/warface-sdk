<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Wnull\Warface\HttpClient\Message\ResponseMediator;
use Wnull\Warface\HttpClient\Message\ResponseMediatorInterface;

class WarfaceApiException extends Exception
{
    public function __construct(string $message, int $statusCode = 0)
    {
        parent::__construct($message, $statusCode);
    }
}
