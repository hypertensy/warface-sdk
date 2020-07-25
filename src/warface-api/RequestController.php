<?php

namespace Warface;

class RequestController
{
    const REGION_RU = 'http://api.warface.ru/';
    const REGION_EN = 'http://api.wf.my.com/';

    private string $location;

    /**
     * RequestController constructor.
     * @param string $region
     */
    public function __construct(string $region)
    {
        if (!in_array($region, [self::REGION_RU, self::REGION_EN])) {
            throw new \InvalidArgumentException('Incorrect region');
        }

        $this->location = $region;
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     */
    public function request(string $url, array $params = []): array
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL             => $this->location . $url . '/?' . http_build_query($params),
            CURLOPT_RETURNTRANSFER  => true
        ]);

        $content = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        switch ($http_code)
        {
            case 400:
            case 404:
                throw new \InvalidArgumentException('Invalid request' . $content);
                break;
        }

        return json_decode($content, true);
    }
}