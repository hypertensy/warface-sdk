<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Wnull\Warface\Enum\Http\RegionList;

use function sprintf;

final readonly class ServerSupportPlugin implements Plugin
{
    public function __construct(
        private RegionList $region = RegionList::CIS
    ) {}

    public function getServerUri(): string
    {
        return match ($this->region) {
            RegionList::CIS => $this->resolve(RegionList::CIS),
            RegionList::INTERNATIONAL => $this->resolve(RegionList::INTERNATIONAL),
        };
    }

    public function makeAddHostPlugin(): AddHostPlugin
    {
        return new AddHostPlugin(
            Psr17FactoryDiscovery::findUriFactory()->createUri($this->getServerUri())
        );
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request);
    }

    protected function resolve(RegionList $region): string
    {
        return sprintf('https://%s/', $region->value);
    }
}
