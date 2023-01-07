<?php

declare(strict_types=1);

namespace Wnull\Warface\Contracts;

use Wnull\Warface\Enum\Http\RegionList;

interface ClientFeaturesInterface
{
    /**
     * A method for switching the API host, you can use it if you need to follow the API for international.
     *
     * @see RegionList
     */
    public function setServer(RegionList $region): void;

    /**
     * A request control system is enabled for the CIS region. Two or more identical requests running in a row cause
     * a long response or timeout from the API. In rare cases, error 429 is returned.
     *
     * This plugin bypasses the API logic due to a vulnerability in nginx.
     *
     * @see BypassTimeoutResponsePlugin
     * @author Vasily M <wnullx@yandex.com>
     */
    public function onBypassTimeout(): void;
}
