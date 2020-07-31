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

    /**
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    public function __call($methodName, $arguments)
    {
        $class = __NAMESPACE__ . "\Methods\\" . ucfirst($methodName);

        if (!class_exists($class)) {
            throw new \RuntimeException('Class not found');
        }

        return new $class($this->controller);
    }
}