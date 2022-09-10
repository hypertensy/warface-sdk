<?php

declare(strict_types=1);

namespace Warface\Utils;

use function array_filter;
use function array_key_exists;
use function array_map;
use function array_pop;
use function array_shift;
use function explode;
use function str_replace;

class FullResponse
{
    public const ABSENCE_MUTATION_FULL_FIELD  = 0;
    public const REMOVE_RESPONSE_FULL_FIELD   = 1;
    public const TO_ARRAY_RESPONSE_FULL_FIELD = 2;

    /**
     * Recursively converts raw data into an array.
     *
     * @param string $data
     * @return array
     */
    public static function format(string $data): array
    {
        $items = array_filter(array_map('trim', explode('<Sum>', $data)));

        $result = [];
        foreach ($items as $item) {
            $item = str_replace(['[', ']'], ['', ' '], $item);
            [$key, $value] = explode('  = ', $item);

            static::makeIt($result, $key, +$value);
        }

        return $result;
    }

    /**
     * @param array $result
     * @param string $key
     * @param int $value
     */
    private static function makeIt(array &$result, string $key, int $value)
    {
        $keys = explode(' ', $key);
        $last = array_pop($keys);

        while ($current = array_shift($keys))
        {
            if (! array_key_exists($current, $result)) {
                $result[$current] = [];
            }

            $result = &$result[$current];
        }

        $result[$last] = $value;
    }
}
