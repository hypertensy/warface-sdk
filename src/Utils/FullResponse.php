<?php

namespace Warface\Utils;

class FullResponse
{
	/**
	 * Recursively converts text data into an array.
	 * @param string $data
	 * @return array
	 */
	public function format(string $data): array
	{
		$make = function (array &$result, string $key, int $value) {
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
		};

		$items = array_filter(array_map('trim', explode('<Sum>', $data)));

		$result = [];
		foreach ($items as $item) {
			$item = str_replace(['[', ']'], ['', ' '], $item);
			[$key, $value] = explode('  = ', $item);
			$make($result, $key, +$value);
		}

		return $result;
	}
}