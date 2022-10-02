<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;
use Warface\Interfaces\Methods\AchievementInterface as Achievement;

class AchievementTest extends TestCase
{
    protected Achievement $achievement;

    public function setUp(): void
    {
        $this->achievement = (new WarfaceClient(Region::INTERNATIONAL))->achievement();
    }

    public function testCatalog(): void
    {
        $this->assertIsArray($this->achievement->catalog());
    }
}
