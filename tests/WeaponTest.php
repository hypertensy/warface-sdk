<?php

class WeaponTest extends \PHPUnit\Framework\TestCase
{
    protected Warface\ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new Warface\ApiClient();
    }

    public function testMethodCatalog()
    {
        $this->assertIsArray($this->client->weapon()->catalog());
    }
}