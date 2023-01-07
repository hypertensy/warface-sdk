<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Random\Randomizer;
use Wnull\Warface\Enum\Http\RegionList;
use Wnull\Warface\Helper\QueryParamsHelper;

final readonly class BypassTimeoutResponsePlugin implements Plugin
{
    protected const QUERY_PARAM_KEY  = 'name';
    protected const PREFIX_VALUE_CHR = '<';

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        if ($request->getUri()->getHost() === RegionList::CIS->value) {

            $query = QueryParamsHelper::modify(
                $request->getUri()->getQuery(),
                $this->getQueryKey(),
                $this->generateRandomCode()
            );

            $request = $request->withUri($request->getUri()->withQuery($query));
        }

        return $next($request);
    }

    protected function generateRandomCode(): string
    {
        return self::PREFIX_VALUE_CHR . (new Randomizer())->nextInt();
    }

    protected function getQueryKey(): string
    {
        return self::QUERY_PARAM_KEY;
    }
}
