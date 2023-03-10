<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Wnull\Warface\Api\AbstractApi;
use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\AchievementInterface;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\ClanInterface;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Api\GameInterface;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\RatingInterface;
use Wnull\Warface\Api\User;
use Wnull\Warface\Api\UserInterface;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\Api\WeaponInterface;
use Wnull\Warface\Enum\EntityList;
use Wnull\Warface\Exception\InvalidApiEndpointException;
use Wnull\Warface\Factory\RequesterFactoryTrait;

/**
 * @method AchievementInterface achievement() Achievement branch
 * @method ClanInterface clan() Clan branch
 * @method GameInterface game() Game branch
 * @method RatingInterface rating() Rating branch
 * @method UserInterface user() User branch
 * @method WeaponInterface weapon() Weapon branch
 */
final class Client
{
    use RequesterFactoryTrait;

    /**
     * @throws InvalidApiEndpointException
     */
    public function __call(string $entity, array $arguments = []): AbstractApi
    {
        switch ($entity) {
            case EntityList::ACHIEVEMENT:
                return new Achievement($this->getRequester());
            case EntityList::CLAN:
                return new Clan($this->getRequester());
            case EntityList::GAME:
                return new Game($this->getRequester());
            case EntityList::RATING:
                return new Rating($this->getRequester());
            case EntityList::USER:
                return new User($this->getRequester());
            case EntityList::WEAPON:
                return new Weapon($this->getRequester());
            default:
                throw new InvalidApiEndpointException();
        }
    }
}
