<?php

declare(strict_types=1);

namespace Wnull\Warface\Tests\Api;

use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\AchievementInterface;
use Wnull\Warface\Exception\WarfaceApiException;

beforeEach(fn () => $this->apiClass = Achievement::class);

it(
    'can request a catalog of achievements',
    /**
     * @throws WarfaceApiException
     */
    function () {
        /** @var AchievementInterface $api */
        $api = $this->getApi();

        $element = $this->getRandomElement($api->catalog());

        expect($element)
            ->toHaveKey('id')
            ->toHaveKey('name_en')
            ->toHaveKey('name_es')
            ->toHaveKey('name_pl')
            ->toHaveKey('name_de')
            ->toHaveKey('name_fr')
            ->toHaveKey('name_cn')
            ->toHaveKey('name_ko')
            ->toHaveKey('name_pt')
            ->toHaveKey('name_tr');
    }
);
