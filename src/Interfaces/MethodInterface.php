<?php

declare(strict_types=1);

namespace Warface\Interfaces;

use Warface\Interfaces\Methods\AchievementInterface;
use Warface\Interfaces\Methods\ClanInterface;
use Warface\Interfaces\Methods\GameInterface;
use Warface\Interfaces\Methods\RatingInterface;
use Warface\Interfaces\Methods\UserInterface;
use Warface\Interfaces\Methods\WeaponInterface;

interface MethodInterface
{
    /**
     * @return AchievementInterface
     */
    public function achievement(): AchievementInterface;

    /**
     * @return ClanInterface
     */
    public function clan(): ClanInterface;

    /**
     * @return GameInterface
     */
    public function game(): GameInterface;

    /**
     * @return RatingInterface
     */
    public function rating(): RatingInterface;

    /**
     * @return UserInterface
     */
    public function user(): UserInterface;

    /**
     * @return WeaponInterface
     */
    public function weapon(): WeaponInterface;
}
