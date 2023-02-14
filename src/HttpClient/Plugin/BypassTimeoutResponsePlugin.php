<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\QueryDefaultsPlugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Random\Randomizer;
use Wnull\WarfaceSdk\HttpClient\Enum\RegionList;

use function http_build_query;
use function parse_str;
use function str_contains;

class BypassTimeoutResponsePlugin extends QueryDefaultsPlugin implements Plugin
{
    protected Randomizer $randomizer;

    public function __construct()
    {
        parent::__construct([]);

        $this->randomizer = new Randomizer();
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();

        if (str_contains(RegionList::CIS->value, $uri->getHost())) {
            $code = '<' . $this->randomizer->nextInt();
            $params = [];

            parse_str($uri->getQuery(), $params);

            $params['name'] = isset($params['name']) ? $params['name'] . $code : $code;
            $query = http_build_query($params);

            $request = $request->withUri($uri->withQuery($query));
        }

        return $next($request);
    }
}
