<?php

declare(strict_types=1);

namespace Warface\Interfaces;

interface ClientInterface
{
    /**
     * @param string $branch
     * @param array $params
     * @return array
     */
    public function request(string $branch, array $params = []): array;

    /**
     * @param string $ip
     * @param string|null $auth
     */
    public function setProxy(string $ip, string $auth = null): void;
}
