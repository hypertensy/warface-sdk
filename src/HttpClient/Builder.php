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
use Psr\Http\Message\StreamFactoryInterface;

final class Builder
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    public StreamFactoryInterface $streamFactory;

    /**
     * @var array<int, Plugin>
     */
    private array $plugins = [];

    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null,
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return new HttpMethodsClient(
            (new PluginClientFactory())->createClient($this->httpClient, $this->plugins),
            $this->requestFactory,
            $this->streamFactory,
        );
    }

    public function addPlugin(Plugin $plugin): void
    {
        $this->plugins[] = $plugin;
    }
}
