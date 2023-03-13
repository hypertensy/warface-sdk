<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Wnull\Warface\Api\GameInterface;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Exception\WarfaceApiException;

beforeEach(fn () => $this->apiClass = Game::class);

it(
    'can request a game missions',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var GameInterface $api */
        $api = $this->getApi();

        $element = $this->getRandomElement($api->missions());

        expect($element)
            ->toHaveKey('game_mode')
            ->toHaveKey('name')
            ->toHaveKey('mission_type');
    }
);
