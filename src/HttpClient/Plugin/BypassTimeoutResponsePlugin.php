<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Plugin;

use Exception;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Wnull\Warface\Enum\HostList;

use function bin2hex;
use function http_build_query;
use function parse_str;
use function random_bytes;

/**
 * A request control system is enabled for the CIS region. Two or more identical requests running in a row cause
 * a long response or timeout from the API.
 *
 * This plugin bypasses the API logic due to a vulnerability in nginx.
 */
final class BypassTimeoutResponsePlugin implements Plugin
{
    /**
     * @throws Exception
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        $uri = $request->getUri();

        if (str_contains(HostList::CIS, $uri->getHost())) {
            $code = '<' . bin2hex(random_bytes(32));
            $params = [];

            parse_str($uri->getQuery(), $params);

            $params['name'] = isset($params['name']) ? $params['name'] . $code : $code;
            $query = http_build_query($params);

            $request = $request->withUri($uri->withQuery($query));
        }

        return $next($request);
    }
}
