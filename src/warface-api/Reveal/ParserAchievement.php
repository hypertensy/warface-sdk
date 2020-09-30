<?php

namespace Warface\Reveal;

class ParserAchievement
{
    public const HOST = 'https://wfts.su/';
    public const CATALOG = 'achievements';

    public array $cfg = [
        'cache_time' => 604800,
        'cache_file' => __DIR__ . DIRECTORY_SEPARATOR . 'Cache/cache.json'
    ];

    /**
     * ParserAchievement constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (in_array($key, ['cache_time', 'cache_file'])) $this->cfg[$key] = $value ?? $this->cfg[$key];
        }
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $file = $this->cfg['cache_file'];

        if (!(file_exists($file) && (filemtime($file) > (time() - $this->cfg['cache_time'])))) {
            file_put_contents($file, json_encode($this->start()), LOCK_EX);
        }

        return json_decode(file_get_contents($file), true);
    }

    /**
     * @return array
     */
    private function start(): array
    {
        $dom = new \DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML(file_get_contents(self::HOST . self::CATALOG));
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $page = $xpath->query('//div[not(contains(@id, "new"))]/div[starts-with(@class,"achievement ")]');

        $resource = [];
        foreach ($page as $value)
        {
            $resource[] = [
                'gid' => str_replace('id_', '', $xpath->query('./@id', $value)->item(0)->nodeValue),
                'img' => $xpath->query('./div/img/@src', $value)->item(0)->nodeValue,
                'name' => $xpath->query('./div/a', $value)->item(0)->nodeValue
            ];
        }

        return $resource;
    }

    /**
     * @param string $url
     * @param string $file
     */
    public function saveImage(string $url, string $file): void
    {
        $ch = curl_init($url);
        $fp = fopen($file, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}