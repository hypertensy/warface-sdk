<?php

namespace Warface;

use Warface\Enums\{Locale, ErrorMsg};
use Warface\Methods\{Achievement, Clan, Game, Rating, User, Weapon};

/**
 * Class Client
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
	private string $locale;

	private array $locations = [
		Locale::CIS           => 'https://api.warface.ru/',
		Locale::INTERNATIONAL => 'https://api.wf.my.com/'
	];

	/**
	 * Client constructor.
	 * @param string $locale
	 */
	public function __construct(string $locale = Locale::CIS)
	{
		if (! isset($this->locations[$locale])) {
			throw new \InvalidArgumentException(ErrorMsg::REGION);
		}

		$this->locale = $locale;
	}

	/**
	 * A magic method for calling the method of the required API branch.
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call(string $name, array $arguments)
	{
		$class = __NAMESPACE__ . "\Methods\\" . ucfirst($name);

		if (! class_exists($class)) {
			throw new \RuntimeException(ErrorMsg::BRANCH);
		}

		return new $class($this);
	}

	/**
	 * Makes a request to the API and returns the processed result.
	 * @param string $branch
	 * @param array $params
	 * @return mixed
	 */
	public function request(string $branch, array $params = [])
	{
		$ch = curl_init();

		curl_setopt_array($ch, [
			CURLOPT_URL => $this->locations[$this->locale] . $branch . '?' . http_build_query($params),
			CURLOPT_RETURNTRANSFER => true
		]);

		$content = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($code === 200 || $code === 400) {
			return json_decode($content, true);
		}
		else {
			throw new \DomainException(ErrorMsg::UNKNOWN);
		}
	}

	/**
	 * Returns information about the current locale.
	 * @return array
	 */
	public function session(): array
	{
		return [
			'locale'   => $this->locale,
			'location' => $this->locations[$this->locale]
		];
	}
}