<?php

namespace Warface;

use Warface\Exceptions\RequestExceptions;

class RequestController
{
    public const REGION_RU = 'http://api.warface.ru/';
    public const REGION_EN = 'http://api.wf.my.com/';

    private string $location;

    /**
     * RequestController constructor.
     * @param string $region
     */
    public function __construct(string $region)
    {
        if (!in_array($region, [self::REGION_RU, self::REGION_EN])) {
            throw new \InvalidArgumentException('Incorrect region', 102);
        }

        $this->location = $region;
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     * @throws RequestExceptions
     */
    public function request(string $url, array $params = []): array
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL             => sprintf('%s?%s', $this->location . $url, http_build_query($params)),
            CURLOPT_RETURNTRANSFER  => true
        ]);

        $content = curl_exec($ch);

        switch (curl_getinfo($ch, CURLINFO_HTTP_CODE))
        {
            case 404:
                throw new RequestExceptions('Invalid request', 100);
                break;
        }

        return json_decode($content, true);
    }
}