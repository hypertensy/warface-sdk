<?php

declare(strict_types=1);

namespace WarfaceTest\Methods;

use PHPUnit\Framework\TestCase;
use Warface\Client as WarfaceClient;
use Warface\Interfaces\Methods\WeaponInterface as Weapon;

class WeaponTest extends TestCase
{
    protected Weapon $weapon;

    public function setUp(): void
    {
        $this->weapon = (new WarfaceClient())->weapon();
    }

    public function testCatalog(): void
    {
        $this->assertIsArray($this->weapon->catalog());
    }
}
