<?php

declare(strict_types=1);

namespace WarfaceTest;

use Warface\Client as WarfaceClient;
use PHPUnit\Framework\TestCase;
use Warface\Interfaces\Methods\AchievementInterface;
use Warface\Interfaces\Methods\ClanInterface;
use Warface\Interfaces\Methods\GameInterface;
use Warface\Interfaces\Methods\RatingInterface;
use Warface\Interfaces\Methods\UserInterface;
use Warface\Interfaces\Methods\WeaponInterface;

class ClientTest extends TestCase
{
    protected WarfaceClient $client;

    public function setUp(): void
    {
        $this->client = new WarfaceClient();
    }

    public function testAchievementInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            AchievementInterface::class,
            [$this->client->achievement()]
        );
    }

    public function testClanInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            ClanInterface::class,
            [$this->client->clan()]
        );
    }

    public function testGameInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            GameInterface::class,
            [$this->client->game()]
        );
    }

    public function testRatingInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            RatingInterface::class,
            [$this->client->rating()]
        );
    }

    public function testUserInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            UserInterface::class,
            [$this->client->user()]
        );
    }

    public function testWeaponInstance(): void
    {
        $this->assertContainsOnlyInstancesOf(
            WeaponInterface::class,
            [$this->client->weapon()]
        );
    }
}
