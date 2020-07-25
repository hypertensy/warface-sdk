<?php

namespace Warface;

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

    public function __call($methodName, $arguments)
    {
        $class = "\Warface\Methods\\$methodName";

        if (!class_exists($class)) {
            throw new \RuntimeException('Class not found');
        }

        return new $class($this->controller);
    }
}