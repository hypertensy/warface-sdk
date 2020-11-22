<?php

class GameTest extends \PHPUnit\Framework\TestCase
{
    protected Warface\ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new Warface\ApiClient();
    }

    public function testMethodMissions()
    {
        $this->assertIsArray($this->client->game()->missions());
    }
}