<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected Warface\ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new Warface\ApiClient();
    }

    /**
     * @param string $name
     * @param int $server
     * @param int $format
     */
    public function testMethodStat(string $name = 'Сцена', int $server = \Warface\Enums\GameServer::ALPHA, int $format = 0)
    {
        $this->assertIsArray($this->client->user()->stat($name, $server, $format));
    }

    /**
     * @param string $name
     * @param int $server
     */
    public function testMethodAchievements(string $name = 'Сцена', int $server = \Warface\Enums\GameServer::ALPHA)
    {
        $this->assertIsArray($this->client->user()->achievements($name, $server));
    }
}