<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;
use Warface\Interfaces\Methods\ClanInterface as Clan;

use function array_rand;

class ClanTest extends TestCase
{
    protected Clan $clan;
    protected ?string $clan_name = null;

    public function setUp(): void
    {
        $instance = new WarfaceClient(Region::INTERNATIONAL);
        $this->clan = $instance->clan();

        $clans = $instance->rating()->clan();
        $this->clan_name = $clans[array_rand($clans)]['clan'];
    }

    public function testMembers(): void
    {
        $this->assertIsArray($this->clan->members($this->clan_name));
    }
}
