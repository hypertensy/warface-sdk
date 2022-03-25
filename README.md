# Warface API SDK for PHP

[![Travis (.org)](https://img.shields.io/travis/wnull/warface-api)](https://travis-ci.com/wnull/warface-api) ![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/wnull/warface-api)

A fast Warface API SDK library.

> :warning: Recently, the game API server switched to a secure connection, if you have problems receiving data, then replace the protocol with HTTPS.

## References

- [Official API documentation](https://ru.warface.com/wiki/index.php/API)
- [SDK Documentation](#using)

## Installation

Via Composer:

```shell
$ composer require wnull/warface-api
```

## Using

To change the location, you need to pass the desired value to the class constructor. The default location is the CIS.
```php
$client = new Warface\Client(WarfaceTypes\Location::CIS); // Russian servers
$client = new Warface\Client(WarfaceTypes\Location::INTERNATIONAL); // Europe servers
```

Detailed documentation of the library methods. Each of the methods returns data as an associative array.

Go to the branch methods:

- [Achievement](#achievement-methods)
- [Clan](#clan-methods)
- [Game](#game-methods)
- [Rating](#rating-methods)
- [User](#user-methods)
- [Weapon](#weapon-branch)

### Achievement methods

The `catalog()` method does not accept arguments.

Returns information about game achievements.

```php
$client = new Warface\Client();
$catalog = $client->achievement()->catalog();
```

### Clan methods

The `clan()` method accepts **required** the `clan` parameter, which corresponds to the name of the clan.

Returns information about the members of the clan: nickname, the number of their points, rank, role in the clan.

```php
$client = new Warface\Client();
$members = $client->clan()->members('<clan_name>');
```

### Game methods

The `missions()` method does not accept arguments.

Returns extended information about current PVE missions: the required completion time is comparable to game rewards, the number of crowns, information about maps, and so on.

```php
$client = new Warface\Client();
$missions = $client->game()->missions();
```

### Rating methods

The `monthly()` method takes 1 **required** parameter `clan` and 2 **optional** parameters: `league` and `page`, the default value of which is `0`.

Returns extended information about current PVE missions: the required completion time is comparable to game rewards, the number of crowns, information about maps, and so on.

```php
$client = new Warface\Client();
$monthly = $client->rating()->monthly('<clan_name>');
```

The `clan()` method does not accept arguments.

Returns information about the clans rating.

```php
$client = new Warface\Client();
$catalog = $client->rating()->clan();
```

The `top100()` accepts an **optional** numeric parameter `class`.

Returns information about the TOP-100 rating of players. When specifying a parameter, it selects a specific game class.

```php
$client = new Warface\Client();
$top100 = $client->rating()->top100();

/**
 * Five game classes are allowed: Rifleman, Medic, Engineer, Sniper, SED
 *
 * @see Warface\Enums\Game\ClassesEnum
 */
$top100 = $client->rating()->top100(WarfaceTypes\ClassesEnum::MEDIC);
```

### User methods

The `stat()` method accepts the 1 **required** parameter `nickname` and 1 **optional** parameter `format`.

The `format` parameter interacts with the `full_response` field.

Returns extended information about the player.

```php
$client = new Warface\Client();

/**
 * By default, the value is 0, and the data comes from the API in raw form.
 */
$stat = $client->user()->stat('<nickname>');

/**
 * If you pass the value 1, this field `full_response` will be deleted.
 */
$stat = $client->user()->stat('<nickname>', 1);

/**
 * If you pass the value 2, the field `full_response` data will be recursively
 * processed into an array and returned with the main fields.
 *
 * @see Warface\Utils\FullResponse
 */
$stat = $client->user()->stat('<nickname>', 2);
```

The `achievements()` method accepts the **required** `nickname` parameter.

Returns extended information about the player's achievements.

```php
$client = new Warface\Client();
$achievements = $client->user()->achievements('<nickname>');
```

### Weapon branch

The `catalog()` method does not accept arguments.

Returns information about game weapons.

```php
$client = new Warface\Client();
$catalog = $client->weapon()->catalog();
```

## License

[MIT](LICENSE)

