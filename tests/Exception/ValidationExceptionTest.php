<?php

namespace WarfaceTest\Exception;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;
use Warface\Exceptions\ValidationException;

use function array_rand;

class ValidationExceptionTest extends TestCase
{
    public function testInvalidLocation(): void
    {
        $this->expectException(ValidationException::class);

        $invalidLocations = ['asia', 'africa'];
        new WarfaceClient($invalidLocations[array_rand($invalidLocations)]);
    }

    public function testValidLocation(): void
    {
        $validLocations = [Region::CIS, Region::INTERNATIONAL];
        new WarfaceClient($validLocations[array_rand($validLocations)]);

        $this->assertTrue(true);
    }
}
