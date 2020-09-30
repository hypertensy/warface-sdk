<?php

namespace Warface;

use Warface\Exceptions\ApiClientExceptions;

class ApiClient
{
    private RequestController $controller;
    public string $region_lang;

    /**
     * ApiClient constructor.
     * @param string $region
     * @throws ApiClientExceptions
     */
    public function __construct(string $region = RequestController::REGION_RU)
    {
        $this->controller = new RequestController($this->_setLanguage($region));
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

    /**
     * @param string $region
     * @return string
     * @throws ApiClientExceptions
     */
    private function _setLanguage(string $region): string
    {
        switch ($region)
        {
            case RequestController::REGION_RU:
                $lng = 'russian';
                break;

            case RequestController::REGION_EN:
                $lng = 'english';
                break;

            default:
                throw new ApiClientExceptions('Invalid region specified', 101);
                break;
        }

        $this->region_lang = $lng;

        return $region;
    }
}
