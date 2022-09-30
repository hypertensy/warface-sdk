<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Classes\Enumeration as GameClass;
use Warface\Enums\League;
use Warface\Interfaces\Methods\RatingInterface as Rating;

use function array_rand;

class RatingTest extends TestCase
{
    protected Rating $rating;

    public function setUp(): void
    {
        $this->rating = (new WarfaceClient())->rating();
    }

    public function testClan(): void
    {
        $this->assertIsArray($this->rating->clan());
    }

    public function testTop100(): void
    {
        $class = [
            GameClass::RIFLEMAN,
            GameClass::MEDIC,
            GameClass::ENGINEER,
            GameClass::SNIPER,
            GameClass::SED
        ];

        $this->assertIsArray(
            $this->rating->top100($class[array_rand($class)])
        );
    }

    public function testMonthly(): void
    {
        $league = [
            League::ELITE_LEAGUE,
            League::PLATINUM_LEAGUE,
            League::GOLDEN_LEAGUE,
            League::SILVER_LEAGUE,
            League::BRONZE_LEAGUE,
            League::STEEL_LEAGUE
        ];

        $this->assertIsArray(
            $this->rating->monthly(null, $league[array_rand($league)])
        );
    }
}
