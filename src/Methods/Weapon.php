<?php

namespace Warface\Methods;

use Warface\Client;

class Weapon
{
	private Client $controller;

	/**
	 * Weapon constructor.
	 * @param Client $controller
	 */
	public function __construct(Client $controller)
	{
		$this->controller = $controller;
	}

	/**
	 * Gets the catalog of game weapons.
	 * @return array
	 */
	public function catalog(): array
	{
		return $this->controller->request('weapon/catalog');
	}
}