<?php

namespace Warface\Methods;

use Warface\Client;

class Clan
{
	private Client $controller;

	/**
	 * Clan constructor.
	 * @param Client $controller
	 */
	public function __construct(Client $controller)
	{
		$this->controller = $controller;
	}

	/**
	 * Gets information about the members of the clan.
	 * @param string $clan
	 * @return array
	 */
	public function members(string $clan): array
	{
		return $this->controller->request('clan/members', [
			'clan' => $clan
		]);
	}
}