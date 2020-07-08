<?php

namespace Warface;

use Warface\Methods\{Achievement, Game, Rating, User, Clan, Weapon};

class ApiClient
{
    private RequestController $controller;

    /**
     * ApiClient constructor.
     * @param string $region
     */
    public function __construct(string $region = RequestController::REGION_RU)
    {
        $this->controller = new RequestController($region);
    }

    /**
     * @return User
     */
    public function user(): User
    {
        return new User($this->controller);
    }

    /**
     * @return Rating
     */
    public function rating(): Rating
    {
        return new Rating($this->controller);
    }

    /**
     * @return Clan
     */
    public function clan(): Clan
    {
        return new Clan($this->controller);
    }

    /**
     * @return Weapon
     */
    public function weapon(): Weapon
    {
        return new Weapon($this->controller);
    }

    /**
     * @return Achievement
     */
    public function achievement(): Achievement
    {
        return new Achievement($this->controller);
    }

    /**
     * @return Game
     */
    public function game(): Game
    {
        return new Game($this->controller);
    }
}