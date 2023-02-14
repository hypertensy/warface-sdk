<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Wnull\WarfaceSdk\HttpClient\Enum\RegionList;

readonly class RegionSwitcherPlugin implements Plugin
{
    public function __construct(private RegionList $region = RegionList::CIS)
    {
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request);
    }

    public function toHostPlugin(): AddHostPlugin
    {
        return new AddHostPlugin(
            Psr17FactoryDiscovery::findUriFactory()->createUri($this->region->value)
        );
    }
}
