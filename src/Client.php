<?php

declare(strict_types=1);

namespace Warface;

use Warface\Interfaces\MethodInterface;
use Warface\Interfaces\Methods\AchievementInterface;
use Warface\Interfaces\Methods\ClanInterface;
use Warface\Interfaces\Methods\GameInterface;
use Warface\Interfaces\Methods\RatingInterface;
use Warface\Interfaces\Methods\UserInterface;
use Warface\Interfaces\Methods\WeaponInterface;
use Warface\Methods\Achievement;
use Warface\Methods\Clan;
use Warface\Methods\Game;
use Warface\Methods\Rating;
use Warface\Methods\User;
use Warface\Methods\Weapon;

class Client extends Request implements MethodInterface
{
    /**
     * Achievement branch.
     *
     * @return AchievementInterface
     */
    public function achievement(): AchievementInterface
    {
        return new Achievement($this);
    }

    /**
     * Clan branch.
     *
     * @return ClanInterface
     */
    public function clan(): ClanInterface
    {
        return new Clan($this);
    }

    /**
     * Game branch.
     *
     * @return GameInterface
     */
    public function game(): GameInterface
    {
        return new Game($this);
    }

    /**
     * Rating branch.
     *
     * @return RatingInterface
     */
    public function rating(): RatingInterface
    {
        return new Rating($this);
    }

    /**
     * User branch.
     *
     * @return UserInterface
     */
    public function user(): UserInterface
    {
        return new User($this);
    }

    /**
     * Weapon branch.
     *
     * @return WeaponInterface
     */
    public function weapon(): WeaponInterface
    {
        return new Weapon($this);
    }
}
