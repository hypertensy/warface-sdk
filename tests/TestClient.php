<?php

namespace TestWarface;

use Warface\{Client, Enums\Game\ClassesType, Enums\Game\Servers, Enums\Location};

class TestClient extends \PHPUnit\Framework\TestCase
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
                'members' => ['name' => 'Суприм', 'server' => Servers::ALPHA]
            ],
            'game' => [
                'missions' => []
            ],
            'rating' => [
                'monthly' => ['server' => Servers::ALPHA, 'name' => 'Манул'],
                'clan'    => ['server' => Servers::BRAVO],
                'top100'  => ['server' => Servers::CHARLIE, 'class' => ClassesType::RIFLEMAN]
            ],
            'user' => [
                'stat'         => ['name' => 'Элез', 'server' => Servers::ALPHA],
                'achievements' => ['name' => 'Кломми', 'server' => Servers::BRAVO]
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
