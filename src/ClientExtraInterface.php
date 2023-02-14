<?php

declare(strict_types=1);

namespace Wnull\WarfaceSdk;

use Closure;
use Wnull\WarfaceSdk\HttpClient\Enum\RegionList;
use Wnull\WarfaceSdk\HttpClient\Exception\BadRequestException;
use Wnull\WarfaceSdk\HttpClient\Plugin\BadRequestCatcherPlugin;

interface ClientExtraInterface
{
    /**
     * A method for switching the API host, you can use it if you need to follow the API for international.
     *
     * @see RegionList
     */
    public function setRegion(RegionList $region): self;

    /**
     * A request control system is enabled for the CIS region. Two or more identical requests running in a row cause
     * a long response or timeout from the API. In rare cases, error 429 is returned.
     *
     * This plugin bypasses the API logic due to a vulnerability in nginx.
     *
     * @see BypassTimeoutResponsePlugin
     */
    public function setBypassTimeout(): self;

    /**
     * A method for processing failed API requests with status 400 when information is unavailable or not found.
     * By default, it will throw an exception, but you can pass your callback and reverse as you like.
     *
     * @see BadRequestCatcherPlugin
     * @throws BadRequestException
     */
    public function setCatchBadRequest(?Closure $closure = null): self;
}
