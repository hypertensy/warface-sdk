<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Client\Exception;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriInterface;
use Wnull\Warface\Helper\RegionManager;
use Wnull\Warface\HttpClient\Builder;
use Wnull\Warface\HttpClient\Message\ResponseMediator;

final readonly class Client
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin($this->getDefaultUri()));

        $builder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'warface-api-sdk (https://github.com/wnull/warface-api)',
            ])
        );
    }

    protected function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    protected function getDefaultUri(): UriInterface
    {
        return Psr17FactoryDiscovery::findUriFactory()->createUri(RegionManager::getCisServer());
    }

    /**
     * @throws Exception
     */
    public function get(string $path, array $parameters = []): array|bool
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters, arg_separator: '&');
        }

        $response = $this->getHttpClient()->get($path);

        return ResponseMediator::getContent($response);
    }
}
