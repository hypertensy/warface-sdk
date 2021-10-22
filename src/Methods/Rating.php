<?php

namespace Warface\Methods;

use Warface\Client;

class Rating
{
	private Client $controller;

	/**
	 * Rating constructor.
	 * @param Client $controller
	 */
	public function __construct(Client $controller)
	{
		$this->controller = $controller;
	}

	/**
	 * Gets information about the monthly rating.
	 * @param string $clan
	 * @param int $league
	 * @param int $page
	 * @return array
	 */
	public function monthly(string $clan, int $league = 0, int $page = 0): array
	{
		return $this->controller->request('rating/monthly', [
			'clan'   => $clan,
			'league' => $league,
			'page'   => $page
		]);
	}

	/**
	 * Gets information about the rating of clans.
	 * @return array
	 */
	public function clan(): array
	{
		return $this->controller->request('rating/clan');
	}

	/**
	 * Gets information about the TOP-100 rating.
	 * @param int $class
	 * @return array
	 */
	public function top100(int $class = 0): array
	{
		return $this->controller->request('rating/top100', [
			'class'  => $class
		]);
	}
}