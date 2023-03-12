<?php

declare(strict_types=1);

namespace Wnull\Warface\Exception;

final class InvalidApiEndpointException extends WarfaceApiException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message, '');
    }
}
