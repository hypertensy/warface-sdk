<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriInterface;
use Wnull\Warface\Api\AbstractApi;
use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\AchievementInterface;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\ClanInterface;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Api\GameInterface;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\RatingInterface;
use Wnull\Warface\Api\User;
use Wnull\Warface\Api\UserInterface;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\Api\WeaponInterface;
use Wnull\Warface\Enum\EntityList;
use Wnull\Warface\Enum\HostList;
use Wnull\Warface\Enum\RegionEnum;
use Wnull\Warface\Exception\InvalidApiEndpointException;
use Wnull\Warface\HttpClient\ClientBuilder;
use Wnull\Warface\HttpClient\Plugin\BypassTimeoutResponsePlugin;
use Wnull\Warface\HttpClient\Plugin\WarfaceClientExceptionPlugin;

/**
 * @method AchievementInterface achievement() Achievement branch
 * @method ClanInterface clan() Clan branch
 * @method GameInterface game() Game branch
 * @method RatingInterface rating() Rating branch
 * @method UserInterface user() User branch
 * @method WeaponInterface weapon() Weapon branch
 */
final class Client
{
    private ClientBuilder $httpClientBuilder;

    public function __construct(ClientBuilder $httpClientBuilder = null, RegionEnum $region = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new ClientBuilder();

        // Set API host depending on the region
        $host = ($region ?? RegionEnum::CIS())->getValue() === RegionEnum::CIS
            ? HostList::CIS()
            : HostList::INTERNATIONAL();

        $builder->addPlugin(new AddHostPlugin($this->makeHostUri($host)));

        // For CIS region
        $builder->addPlugin(new BypassTimeoutResponsePlugin());

        $builder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'Warface SDK Client; version 5',
            ])
        );

        $builder->addPlugin(new WarfaceClientExceptionPlugin());
    }

    /**
     * @param array<int, mixed> $args
     * @throws InvalidApiEndpointException
     */
    public function __call(string $entity, array $args = []): AbstractApi
    {
        switch ($entity) {
            case EntityList::ACHIEVEMENT:
                return new Achievement($this);
            case EntityList::CLAN:
                return new Clan($this);
            case EntityList::GAME:
                return new Game($this);
            case EntityList::RATING:
                return new Rating($this);
            case EntityList::USER:
                return new User($this);
            case EntityList::WEAPON:
                return new Weapon($this);
            default:
                throw new InvalidApiEndpointException('Call unknown entity');
        }
    }

    public static function createWithHttpClient(ClientInterface $httpClient, RegionEnum $region = null): self
    {
        $builder = new ClientBuilder($httpClient);

        return new self($builder, $region);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): ClientBuilder
    {
        return $this->httpClientBuilder;
    }

    private function makeHostUri(HostList $host): UriInterface
    {
        return Psr17FactoryDiscovery::findUriFactory()->createUri('https://' . $host->getValue());
    }
}
