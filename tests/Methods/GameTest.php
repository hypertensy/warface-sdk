<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;
use Warface\Interfaces\Methods\GameInterface as Game;

class GameTest extends TestCase
{
    protected Game $game;

    public function setUp(): void
    {
        $this->game = (new WarfaceClient(Region::INTERNATIONAL))->game();
    }

    public function testMissions(): void
    {
        $this->assertIsArray($this->game->missions());
    }
}
