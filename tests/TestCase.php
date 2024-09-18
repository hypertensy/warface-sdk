<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Api\AbstractApi;
use Wnull\Warface\Client;
use Wnull\Warface\Enum\RegionEnum;

use function array_rand;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var class-string<AbstractApi>
     */
    protected string $apiClass;

    public function getApi(): AbstractApi
    {
        $client = new Client(null, RegionEnum::CIS());

        return new $this->apiClass($client);
    }

    protected function getRandomElement(array $data): ?array
    {
        return $data[array_rand($data)] ?? null;
    }
}
