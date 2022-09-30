<?php

declare(strict_types=1);

namespace WarfaceTest\Exception;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Exceptions\RequestException;

class RequestExceptionTest extends TestCase
{
    public function testBadRequestWithNonExistPlayer()
    {
        $client = new WarfaceClient();
        $client::$throwOnBadRequest = true;

        $this->expectException(RequestException::class);
        $client->user()->stat('');
    }
}
