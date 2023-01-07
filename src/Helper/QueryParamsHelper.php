<?php

declare(strict_types=1);

namespace Wnull\Warface\Helper;

use function http_build_query;
use function parse_str;

final class QueryParamsHelper
{
    public static function modify(string $query, string $key, string|int $value, bool $concat = true): string
    {
        $params = [];
        parse_str($query, $params);

        $params[$key] = isset($params[$key]) ? ($concat ? $params[$key] . $value : $value) : $value;

        return http_build_query($params);
    }
}
