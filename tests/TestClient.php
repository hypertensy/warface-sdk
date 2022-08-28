<?php

declare(strict_types=1);

namespace TestWarface;

use Warface\Client;
use PHPUnit\Framework\TestCase;
use Warface\Enums\Classes\Enumeration;
use Warface\Enums\Location\Region;

class TestClient extends TestCase
{
    public function testInvalidLocation(): void
    {
        $invalidLocations = ['german', 'italian', 'french'];

        $this->expectException(\InvalidArgumentException::class);
        new Client($invalidLocations[array_rand($invalidLocations)]);
    }

    public function testValidLocation(): void
    {
        $validLocations = [Region::CIS, Region::INTERNATIONAL];

        new Client($validLocations[array_rand($validLocations)]);
        $this->assertTrue(true);
    }

    public function testCallAllMethods(): void
    {
        $branchesAndMethods = [
            'achievement' => [
                'catalog' => []
            ],
            'clan' => [
                'members' => [
                    'name' => 'Репулс'
                ]
            ],
            'game' => [
                'missions' => []
            ],
            'rating' => [
                'monthly' => [
                    'clan' => 'Манул'
                ],
                'clan' => [],
                'top100' => [
                    'class' => Enumeration::RIFLEMAN
                ]
            ],
            'user' => [
                'stat' => [
                    'name' => 'Элез'
                ],
                'achievements' => [
                    'name' => 'Пираний'
                ]
            ],
            'weapon' => [
                'catalog' => []
            ]
        ];

        $client = new Client();

        foreach ($branchesAndMethods as $branch => $method) {
            foreach ($method as $methodName => $methodArgs) {
                $this->assertIsArray(
                    $client
                        ->$branch()
                        ->$methodName(...array_values($methodArgs))
                );
            }
        }
    }
}
