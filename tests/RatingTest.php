<?php

class RatingTest extends \PHPUnit\Framework\TestCase
{
    protected Warface\ApiClient $client;

    protected function setUp(): void
    {
        $this->client = new Warface\ApiClient();
    }

    /**
     * @param int $server
     * @param string $clan
     * @param int $league
     * @param int $page
     */
    public function testMethodMonthly(
        int $server = \Warface\Enums\GameServer::ALPHA,
        string $clan = 'ХзвиРзйн',
        int $league = 0,
        int $page = 0
    )
    {
        $this->assertIsArray($this->client->rating()->monthly($server, $clan, $league, $page));
    }

    /**
     * @param int $server
     */
    public function testMethodClan(int $server = \Warface\Enums\GameServer::ALPHA)
    {
        $this->assertIsArray($this->client->rating()->clan($server));
    }

    public function testMethodTop100(int $server = \Warface\Enums\GameServer::ALPHA, int $class = 1)
    {
        $this->assertIsArray($this->client->rating()->top100($server, $class));
    }
}