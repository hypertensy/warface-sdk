<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Message;

use Psr\Http\Message\ResponseInterface;

interface ResponseMediatorInterface
{
    public function getResponse(): ResponseInterface;

    /**
     * @return array<string|int, mixed>
     */
    public function getBodyContentsDecode(): array;
}
