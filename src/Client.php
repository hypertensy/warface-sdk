<?php

declare(strict_types=1);

namespace Warface;

use JsonException;
use Warface\Enums\Http\Response;
use Warface\Enums\Location\Region;
use Warface\Enums\Location\Server;
use Warface\Exceptions\ExecuteException;
use Warface\Exceptions\RequestException;
use Warface\Exceptions\ValidationException;
use Warface\Interfaces\ClientInterface;
use Warface\Interfaces\MethodInterface;
use Warface\Interfaces\Methods\AchievementInterface;
use Warface\Interfaces\Methods\ClanInterface;
use Warface\Interfaces\Methods\GameInterface;
use Warface\Interfaces\Methods\RatingInterface;
use Warface\Interfaces\Methods\UserInterface;
use Warface\Interfaces\Methods\WeaponInterface;
use Warface\Methods\Achievement;
use Warface\Methods\Clan;
use Warface\Methods\Game;
use Warface\Methods\Rating;
use Warface\Methods\User;
use Warface\Methods\Weapon;

use function sprintf;
use function json_decode;

class Client implements ClientInterface, MethodInterface
{
    public static bool $throwOnBadRequest = false;

    private ?string $proxyIp = null;
    private ?string $proxyAuth = null;

    private string $locale;

    private array $locations = [
        Region::CIS => Server::CIS,
        Region::INTERNATIONAL => Server::INTERNATIONAL
    ];

    /**
     * @param string $locale
     */
    public function __construct(string $locale = Region::CIS)
    {
        if (!isset($this->locations[$locale])) {
            throw new ValidationException('Invalid region specified');
        }

        $this->locale = $locale;
    }

    /**
     * @param string $ip
     * @param string|null $auth
     */
    public function setProxy(string $ip, string $auth = null): void
    {
        $this->proxyIp ??= $ip;
        $this->proxyAuth ??= $auth;
    }

    /**
     * @param string $branch
     * @param array $params
     * @return array
     */
    public function request(string $branch, array $params = []): array
    {
        $ch = curl_init();

        $endpoint = sprintf('https://%s/%s?%s', $this->locations[$this->locale], $branch, http_build_query($params));

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($this->proxyIp) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxyIp);

            if ($this->proxyAuth) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyAuth);
            }
        }

        $content = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (!in_array($code, [Response::OK, Response::BAD_REQUEST], true)) {
            throw new RequestException('API Server error. Error code: ' . $code);
        }

        if (self::$throwOnBadRequest && $code === Response::BAD_REQUEST) {
            throw new RequestException('Bad request: ' . $code);
        }

        try {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ExecuteException($e->getMessage());
        }
    }

    /**
     * @return AchievementInterface
     */
    public function achievement(): AchievementInterface
    {
        return new Achievement($this);
    }

    /**
     * @return ClanInterface
     */
    public function clan(): ClanInterface
    {
        return new Clan($this);
    }

    /**
     * @return GameInterface
     */
    public function game(): GameInterface
    {
        return new Game($this);
    }

    /**
     * @return RatingInterface
     */
    public function rating(): RatingInterface
    {
        return new Rating($this);
    }

    /**
     * @return UserInterface
     */
    public function user(): UserInterface
    {
        return new User($this);
    }

    /**
     * @return WeaponInterface
     */
    public function weapon(): WeaponInterface
    {
        return new Weapon($this);
    }
}
