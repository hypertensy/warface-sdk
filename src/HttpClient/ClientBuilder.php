<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final class ClientBuilder
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;

    /**
     * @var array<int, Plugin>
     */
    private array $plugins = [];

    public function __construct(ClientInterface $httpClient = null, RequestFactoryInterface $requestFactory = null)
    {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        $client = (new PluginClientFactory())->createClient($this->httpClient, $this->plugins);

        return new HttpMethodsClient($client, $this->requestFactory);
    }

    /**
     * @param class-string<Plugin> $className
     */
    public function removePlugin(string $className): void
    {
        foreach ($this->plugins as $idx => $plugin) {
            if ($plugin instanceof $className) {
                unset($this->plugins[$idx]);
            }
        }
    }

    public function addPlugin(Plugin $plugin): void
    {
        $this->plugins[] = $plugin;
    }
}
