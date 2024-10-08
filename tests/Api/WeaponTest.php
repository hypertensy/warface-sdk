<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Wnull\Warface\Api\Weapon;
use Wnull\Warface\Api\WeaponInterface;
use Wnull\Warface\Exception\WarfaceApiException;

/** @deprecated */
beforeEach(fn () => $this->apiClass = Weapon::class);

it(
    'can request a weapon catalog',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var WeaponInterface $api */
        $api = $this->getApi();

        $element = $this->getRandomElement($api->catalog());
        expect($element)->toBeNull();

//      deprecated test
//        expect($element)
//            ->toHaveKey('id')
//            ->toHaveKey('name_en')
//            ->toHaveKey('name_es')
//            ->toHaveKey('name_pl')
//            ->toHaveKey('name_de')
//            ->toHaveKey('name_fr')
//            ->toHaveKey('name_cn')
//            ->toHaveKey('name_ko')
//            ->toHaveKey('name_pt')
//            ->toHaveKey('name_tr');
    }
);
