<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Classes\Enumeration;
use Warface\Helpers\FullResponse;
use Warface\Interfaces\Methods\UserInterface as User;

use function array_rand;

class UserTest extends TestCase
{
    protected User $user;
    protected ?string $nickname = null;

    public function setUp(): void
    {
        $instance = new WarfaceClient();
        $this->user = $instance->user();

        $top100 = $instance->rating()->top100(Enumeration::RIFLEMAN);
        $this->nickname = $top100[array_rand($top100)]['nickname'];
    }

    public function testUserStat(): void
    {
        $player = $this->user->stat($this->nickname, FullResponse::REMOVE_TYPE);

        $this->assertIsArray($player);
        $this->assertArrayNotHasKey('full_response', $player);
    }

    public function testUserAchievements(): void
    {
        $this->assertIsArray($this->user->achievements($this->nickname));
    }
}
