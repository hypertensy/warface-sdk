<?php

declare(strict_types=1);

namespace Warface;

use Warface\Enums\Location\Region;
use Warface\Enums\Location\Servers;
use Warface\Methods\Achievement;
use Warface\Methods\Clan;
use Warface\Methods\Game;
use Warface\Methods\Rating;
use Warface\Methods\User;
use Warface\Methods\Weapon;

/**
 * Class Client
 *
 * @package Warface
 * @method Achievement achievement() Achievement branch
 * @method Clan clan() Clan branch
 * @method Game game() Game branch
 * @method Rating rating() Rating branch
 * @method User user() User branch
 * @method Weapon weapon() Weapon branch
 */
class Client
{
    /**
     * Current locale
     *
     * @var string $locale
     */
    private string $locale;

    /**
     * Configuration of regions with hosts
     *
     * @var array
     */
    private array $locations = [
        Region::CIS           => Servers::CIS,
        Region::INTERNATIONAL => Servers::INTERNATIONAL
    ];

    private ?string $proxyIp = null;
    private ?string $proxyAuth = null;

    /**
     * Client constructor.
     *
     * @param string $locale
     */
    public function __construct(string $locale = Region::CIS)
    {
        if (! isset($this->locations[$locale])) {
            throw new \InvalidArgumentException('Invalid region specified');
        }

        $this->locale = $locale;
    }

    /**
     * A magic method for calling the method of the required API branch.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        $class = sprintf('%s\Methods\%s', __NAMESPACE__, ucfirst($name));

        if (! class_exists($class)) {
            throw new \RuntimeException('The called branch does not exist');
        }

        return new $class($this);
    }

    /**
     * Setter a proxy
     *
     * @param string $ip
     * @param ?string $auth
     */
    public function proxy(string $ip, string $auth = null): void
    {
        $this->proxyIp ??= $ip;
        $this->proxyAuth ??= $auth;
    }

    /**
     * Makes a request to the API and returns the processed result.
     *
     * @param string $branch
     * @param array $params
     * @return mixed
     */
    public function request(string $branch, array $params = []): array
    {
        $ch = curl_init();

        $endpoint = sprintf(
            'https://%s/%s?%s',
            $this->locations[$this->locale],
            $branch,
            http_build_query($params)
        );

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($this->proxyIp) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxyIp);
        }

        if ($this->proxyAuth) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxyAuth);
        }

        $content = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($code === 200 || $code === 400) {
            return json_decode($content, true);
        } else {
            throw new \DomainException('API connection error');
        }
    }
}
