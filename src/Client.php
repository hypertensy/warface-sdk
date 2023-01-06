<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Wnull\Warface\Enum\Http\RegionList;
use Wnull\Warface\HttpClient\Builder;
use Wnull\Warface\HttpClient\Plugin\ServerSupportPlugin;

final readonly class Client
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(
            (new ServerSupportPlugin(RegionList::CIS))->makeAddHostPlugin()
        );

        $builder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'warface-api-sdk (https://github.com/wnull/warface-api)',
            ])
        );
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    public function setServer(RegionList $region): void
    {
        $this->getHttpClientBuilder()->removePlugin(AddHostPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            (new ServerSupportPlugin($region))->makeAddHostPlugin()
        );
    }
}
