<?php

namespace Warface\Methods;

use Warface\{Client, Utils\FullResponse};

class User
{
	private Client $controller;

	/**
	 * User constructor.
	 * @param Client $controller
	 */
	public function __construct(Client $controller)
	{
		$this->controller = $controller;
	}

	/**
	 * Gets information about the player.
	 * @param string $name
	 * @param int $format
	 * @return array
	 */
	public function stat(string $name, int $format = 0): array
	{
		$get = $this->controller->request('user/stat', [
			'name' => $name
		]);

		switch ($format) {
			case 1:
				unset($get['full_response']);
				break;
			case 2:
				$utils = new FullResponse();
				$get['full_response'] = $utils->format($get['full_response']);
				break;
		}

		return $get;
	}

	/**
	 * Gets information about the player's achievements.
	 * @param string $name
	 * @return array
	 */
	public function achievements(string $name): array
	{
		return $this->controller->request('user/achievements', [
			'name' => $name
		]);
	}
}