<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Wnull\WarfaceSdk\HttpClient\Builder;
use Wnull\WarfaceSdk\HttpClient\Enum\RegionList;

final class Options
{
    private array $options;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'client_builder' => new Builder(),
                'uri_factory'    => Psr17FactoryDiscovery::findUriFactory(),
                'uri'            => RegionList::CIS->value,
            ],
        );

        $resolver->setAllowedTypes('uri', 'string');
        $resolver->setAllowedTypes('client_builder', Builder::class);
        $resolver->setAllowedTypes('uri_factory', UriFactoryInterface::class);
    }

    public function getClientBuilder(): Builder
    {
        return $this->options['client_builder'];
    }

    public function getUriFactory(): UriFactoryInterface
    {
        return $this->options['uri_factory'];
    }

    public function getUri(): UriInterface
    {
        return $this->getUriFactory()->createUri($this->options['uri']);
    }
}
