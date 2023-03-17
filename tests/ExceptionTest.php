<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Client;
use Wnull\Warface\Exception\BadRequestException;
use Wnull\Warface\Exception\InvalidApiEndpointException;
use Wnull\Warface\Exception\WarfaceApiException;
use function it;

it(
    'throws invalid api endpoint exception',
    function () {
        (new Client())->test();
    },
)->throws(
    InvalidApiEndpointException::class,
    'Call unknown entity'
);

it(
    'throws bad request user not found',
    function () {
        (new Client())->user()->stat('');
    },
)->throws(
    BadRequestException::class,
    'Пользователь не найден'
);
