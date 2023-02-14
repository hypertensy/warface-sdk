<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk;

use Closure;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Wnull\WarfaceSdk\Api\AbstractApi;
use Wnull\WarfaceSdk\Api\Achievement;
use Wnull\WarfaceSdk\Api\Clan;
use Wnull\WarfaceSdk\Api\Game;
use Wnull\WarfaceSdk\Api\Rating;
use Wnull\WarfaceSdk\Api\User;
use Wnull\WarfaceSdk\Api\Weapon;
use Wnull\WarfaceSdk\Exception\UnknownBranchException;
use Wnull\WarfaceSdk\Exception\UnknownMethodException;
use Wnull\WarfaceSdk\HttpClient\Builder;
use Wnull\WarfaceSdk\HttpClient\Enum\RegionList;
use Wnull\WarfaceSdk\HttpClient\Plugin\BadRequestCatcherPlugin;
use Wnull\WarfaceSdk\HttpClient\Plugin\BypassTimeoutResponsePlugin;
use Wnull\WarfaceSdk\HttpClient\Plugin\RegionSwitcherPlugin;

/**
 * @method Achievement achievement() Achievement branch
 * @method Clan clan() Clan branch
 * @method Game game() Game branch
 * @method Rating rating() Rating branch
 * @method User user() User branch
 * @method Weapon weapon() Weapon branch
 */
class Client implements ClientExtraInterface
{
    private Builder $httpClientBuilder;

    public function __construct(?Options $options = null)
    {
        $options = $options ?? new Options();

        $this->httpClientBuilder = $options->getClientBuilder();

        $this->httpClientBuilder->addPlugin(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'warface sdk client (https://github.com/wnull/warface-sdk)',
            ])
        );

        $this->httpClientBuilder->addPlugin(
            (new RegionSwitcherPlugin())->toHostPlugin()
        );
    }

    public function __call(string $name, array $arguments): AbstractApi
    {
        try {
            return match ($name) {
                'achievement' => new Achievement($this),
                'clan'        => new Clan($this),
                'game'        => new Game($this),
                'rating'      => new Rating($this),
                'user'        => new User($this),
                'weapon'      => new Weapon($this),
                default       => throw new UnknownBranchException('Select unknown branch'),
            };
        } catch (UnknownBranchException $e) {
            throw new UnknownMethodException($e->getMessage(), previous: $e);
        }
    }

    public function setBypassTimeout(): self
    {
        $this->getHttpClientBuilder()->addPlugin(new BypassTimeoutResponsePlugin());

        return $this;
    }

    public function setCatchBadRequest(?Closure $closure = null): self
    {
        $this->getHttpClientBuilder()->addPlugin(new BadRequestCatcherPlugin($closure));

        return $this;
    }

    public function setRegion(RegionList $region): self
    {
        $this->getHttpClientBuilder()->removePlugin(AddHostPlugin::class);
        $this->getHttpClientBuilder()->addPlugin(
            (new RegionSwitcherPlugin($region))->toHostPlugin()
        );

        return $this;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
