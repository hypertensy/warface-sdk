<?php

namespace TestWarface;

use Warface\{Client, Enums\Game\ClassesEnum, Enums\Location};
use PHPUnit\Framework\TestCase;

class TestClient extends TestCase
{
    public function testInvalidLocation()
    {
        $invalidLocations = ['german', 'italian', 'french'];

        $this->expectException(\InvalidArgumentException::class);
        new Client($invalidLocations[array_rand($invalidLocations)]);
    }

    public function testValidLocation()
    {
        $validLocations = [Location::RU, Location::EN];

        new Client($validLocations[array_rand($validLocations)]);
        $this->assertTrue(true);
    }

    public function testCallAllMethods()
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
                    'class' => ClassesEnum::RIFLEMAN
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
                $this->assertIsArray($client->$branch()->$methodName(...array_values($methodArgs)));
            }
        }
    }
}
