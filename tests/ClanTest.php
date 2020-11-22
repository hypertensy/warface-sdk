<?php

class ClanTest extends \PHPUnit\Framework\TestCase
{
    protected Warface\ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new Warface\ApiClient();
    }

    /**
     * @param string $clan
     * @param int $server
     */
    public function testMethodMembers(string $clan = 'ХзвиРзйн', int $server = \Warface\Enums\GameServer::ALPHA)
    {
        $this->assertIsArray($this->client->clan()->members($clan, $server));
    }
}