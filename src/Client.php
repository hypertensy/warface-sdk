<?php

declare(strict_types=1);

namespace Wnull\Warface;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Wnull\Warface\Api\AbstractApi;
use Wnull\Warface\Api\Achievement;
use Wnull\Warface\Api\Clan;
use Wnull\Warface\Api\Game;
use Wnull\Warface\Api\Rating;
use Wnull\Warface\Api\User;
use Wnull\Warface\Api\Weapon;
use Wnull\Warface\Contracts\ClientFeaturesInterface;
use Wnull\Warface\Enum\Http\RegionList;
use Wnull\Warface\Exception\IncorrectBranchException;
use Wnull\Warface\Exception\UnknownMethodCallException;
use Wnull\Warface\HttpClient\Builder;
use Wnull\Warface\HttpClient\Plugin\BypassTimeoutResponsePlugin;
use Wnull\Warface\HttpClient\Plugin\ServerSupportPlugin;

/**
 * @method Achievement achievement() Achievement branch
 * @method Clan clan() Clan branch
 * @method Game game() Game branch
 * @method Rating rating() Rating branch
 * @method User user() User branch
 * @method Weapon weapon() Weapon branch
 */
final readonly class Client implements ClientFeaturesInterface
{
    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(
            (new ServerSupportPlugin())->makeAddHostPlugin()
        );

        $builder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'warface-api-sdk (https://github.com/wnull/warface-api)',
            ])
        );
    }

    public function __call(string $name, array $arguments)
    {
        try {
            return $this->api($name);
        } catch (IncorrectBranchException $e) {
            throw new UnknownMethodCallException('Undefined method called: ' . $name, previous: $e);
        }
    }

    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'achievement' => new Achievement($this),
            'clan'        => new Clan($this),
            'game'        => new Game($this),
            'rating'      => new Rating($this),
            'user'        => new User($this),
            'weapon'      => new Weapon($this),
            default       => throw new IncorrectBranchException(),
        };
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }

    public function onBypassTimeout(): void
    {
        $this->getHttpClientBuilder()->addPlugin(new BypassTimeoutResponsePlugin());
    }

    public function setServer(RegionList $region): void
    {
        $this->getHttpClientBuilder()->removePlugin(AddHostPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            (new ServerSupportPlugin($region))->makeAddHostPlugin()
        );
    }
}
