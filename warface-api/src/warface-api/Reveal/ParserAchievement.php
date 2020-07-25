<?php

namespace Warface\Reveal;

class ParserAchievement
{
    public const HOST = 'https://wfts.su/achievements';

    public array $cfg = [
        'cache_time' => 604800,
        'cache_file' => '/Cache/cache.json'
    ];

    /**
     * ParserAchievement constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->cfg = (isset($data['cache_time']) || isset($data['cache_file'])) ? $data : $this->cfg;
    }

    /**
     * @return string
     */
    public function get(): array
    {
        $file = __DIR__ . $this->cfg['cache_file'];
        $time = $this->cfg['cache_time'];

        if (!(file_exists($file) && (filemtime($file) > (time() - $time)))) {
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
        $dom->loadHTML(file_get_contents(self::HOST));
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
}