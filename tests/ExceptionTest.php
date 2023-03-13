<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Client;
use Wnull\Warface\Exception\InvalidApiEndpointException;

it(
    'throws invalid api endpoint exception',
    function () {
        (new Client())->test();
    },
)->throws(
    InvalidApiEndpointException::class,
    'Call unknown entity'
);
