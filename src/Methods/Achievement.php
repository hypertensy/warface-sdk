<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Client;
use Warface\Interfaces\Methods\AchievementInterface;

class Achievement implements AchievementInterface
{
    public const ACHIEVEMENT_CATALOG_DEFAULT_TYPE     = 0;
    public const ACHIEVEMENT_CATALOG_ALTERNATIVE_TYPE = 1;

    private Client $controller;

    /**
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param int $variant
     * @return array
     */
    public function catalog(int $variant = self::ACHIEVEMENT_CATALOG_DEFAULT_TYPE): array
    {
        $get = [];

        switch ($variant)
        {
            case self::ACHIEVEMENT_CATALOG_DEFAULT_TYPE:
                $get = $this->controller->request('achievement/catalog');
                break;

            case self::ACHIEVEMENT_CATALOG_ALTERNATIVE_TYPE:
                // TODO: Implementing an alternative way to get game achievements
                break;
        }

        return $get;
    }
}
