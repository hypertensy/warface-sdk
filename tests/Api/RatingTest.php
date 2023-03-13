<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\RatingInterface;
use Wnull\Warface\Enum\GameClass;
use Wnull\Warface\Enum\RatingLeague;
use Wnull\Warface\Exception\WarfaceApiException;
use function expect;
use function it;

beforeEach(fn () => $this->apiClass = Rating::class);

it(
    'can request a rating clan',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var RatingInterface $api */
        $api = $this->getApi();

        $element = $this->getRandomElement($api->clan());

        expect($element)
            ->toHaveKey('clan')
            ->toHaveKey('clan_leader')
            ->toHaveKey('points')
            ->toHaveKey('rank');
    }
);

it(
    'can request a rating monthly',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var RatingInterface $api */
        $api = $this->getApi();

        $league = RatingLeague::ELITE();
        $element = $this->getRandomElement($api->monthly('', $league));

        expect($element)
            ->toHaveKey('clan')
            ->toHaveKey('clan_leader')
            ->toHaveKey('members')
            ->toHaveKey('points')
            ->toHaveKey('rank')
            ->toHaveKey('rank_change');
    }
);

it(
    'can request a rating top100',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var RatingInterface $api */
        $api = $this->getApi();

        $class = GameClass::SNIPER();
        $element = $this->getRandomElement($api->top100($class));

        expect($element)
            ->toHaveKey('nickname')
            ->toHaveKey('clan')
            ->toHaveKey('class', $class->getValue())
            ->toHaveKey('shard');
    }
);
