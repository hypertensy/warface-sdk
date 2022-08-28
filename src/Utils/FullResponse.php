<?php

declare(strict_types=1);

namespace Warface\Utils;

class FullResponse
{
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

            static::makeIt($result, $key, $value);
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

        $result[$last] = +$value;
    }
}
