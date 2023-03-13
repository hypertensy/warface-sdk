<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\ClanInterface;
use Wnull\Warface\Exception\WarfaceApiException;

beforeEach(fn () => $this->apiClass = Clan::class);

it(
    'can request a clan members',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var ClanInterface $api */
        $api = $this->getApi();

        $clan = '1337';
        $element = $api->members($clan);

        expect($element)
            ->toHaveKey('id')
            ->toHaveKey('name', $clan)
            ->toHaveKey('members');
    }
);
