<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests;

use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\ClanInterface;
use Wnull\Warface\Api\GameInterface;
use Wnull\Warface\Api\RatingInterface;
use Wnull\Warface\Api\UserInterface;
use Wnull\Warface\Api\WeaponInterface;
use Wnull\Warface\Client;

it('gets instances from the client', function () {
    $client = new Client();

    expect($client->achievement())->toBeInstanceOf(Achievement::class)
    ->and($client->clan())->toBeInstanceOf(ClanInterface::class)
        ->and($client->game())->toBeInstanceOf(GameInterface::class)
        ->and($client->rating())->toBeInstanceOf(RatingInterface::class)
        ->and($client->user())->toBeInstanceOf(UserInterface::class)
        ->and($client->weapon())->toBeInstanceOf(WeaponInterface::class);
});
