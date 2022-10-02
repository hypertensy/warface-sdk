<?php

declare(strict_types=1);

namespace WarfaceTest\Exceptions;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;
use Warface\Exceptions\RequestException;

class RequestExceptionTest extends TestCase
{
    public function testBadRequestWithNonExistPlayer()
    {
        $client = new WarfaceClient(Region::INTERNATIONAL);
        $client::$throwOnBadRequest = true;

        $this->expectException(RequestException::class);
        $client->user()->stat('');
    }
}
