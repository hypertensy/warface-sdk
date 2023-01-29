<?php

declare(strict_types=1);

namespace Warface;

use JsonException;
use Warface\Enums\Http\Response;
use Warface\Enums\Location\Region;
use Warface\Enums\Location\Server;
use Warface\Exceptions\RequestException;
use Warface\Exceptions\ValidationException;
use Warface\Interfaces\RequestInterface;

use function curl_close;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function http_build_query;
use function in_array;
use function json_decode;
use function microtime;

use const CURLINFO_HTTP_CODE;
use const CURLOPT_PROXY;
use const CURLOPT_PROXYUSERPWD;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_URL;
use const JSON_THROW_ON_ERROR;

abstract class Request implements RequestInterface
{
    public static bool $throwOnBadRequest = false;

    protected ?string $proxyIp = null;
    protected ?string $proxyAuth = null;

    protected string $locale;
    protected bool $bypassTimeout;

    protected array $locations = [
        Region::CIS           => Server::CIS,
        Region::INTERNATIONAL => Server::INTERNATIONAL
    ];

    /**
     * @param string $locale
     * @param bool $bypassTimeout
     */
    public function __construct(string $locale = Region::CIS, bool $bypassTimeout = false)
    {
        if (!isset($this->locations[$locale])) {
            throw new ValidationException('Invalid region specified');
        }

        $this->bypassTimeout = $bypassTimeout;
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

        $server = $this->locations[$this->locale];

        /**
         * A request control system is enabled for the CIS region. Two or more identical requests running in a row
         * cause a long response or timeout from the API. In rare cases, error 429 is returned.
         */
        if ($this->bypassTimeout && $server === $this->locations[Region::CIS]) {
            $hash = '<' . microtime(true);
            $params['name'] = isset($params['name']) ? $params['name'] . $hash : $hash;
        }

        $params = http_build_query($params);
        $endpoint = "https://$server/$branch?$params";

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

        if (!$content || !in_array($code, [Response::OK, Response::BAD_REQUEST], true)) {
            throw new RequestException('API server error', $code);
        }

        if (self::$throwOnBadRequest && $code === Response::BAD_REQUEST) {
            throw new RequestException('Bad request', $code);
        }

        try {
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ValidationException($e->getMessage());
        }
    }
}
