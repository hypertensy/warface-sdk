# SDK Documentation 

Full documentation is provided here with a detailed description and instructions for installing and using the library.

> It is recommended to use library version 4.0 and higher.

## Initialization

To change the location, you need to pass the desired value to the class constructor.

```php
require __DIR__ . '../vendor/autoload.php';

$client = new Warface\Client(Warface\Enums\Location\Region::CIS); // Russian servers, by default
$client = new Warface\Client(Warface\Enums\Location\Region::INTERNATIONAL); // Europe servers
```

## Using a proxy

> The proxy connection type is HTTP.

The library supports the use of proxies. You can override the proxy during iterations.

```php
$client->proxy('<ip>:<port>'); // Default use
$client->proxy('<ip>:<port>', '<user>:<pass>'); // Use with auth
```

## API

Go to the branch methods:

- [Achievement](#achievement-methods)
- [Clan](#clan-methods)
- [Game](#game-methods)
- [Rating](#rating-methods)
- [User](#user-methods)
- [Weapon](#weapon-methods)

### Achievement methods

Methods for working with achievements


The `catalog()` method does not accept arguments.

Returns information about game achievements.

```php
$catalog = $client->achievement()->catalog();
```

### Clan methods

The `clan()` method accepts **required** the `clan` parameter, which corresponds to the name of the clan.

Returns information about the members of the clan: nickname, the number of their points, rank, role in the clan.

```php
$members = $client->clan()->members('<clan>');
```

### Game methods

The `missions()` method does not accept arguments.

Returns extended information about current PVE missions: the required completion time is comparable to game rewards, the number of crowns, information about maps, and so on.

```php
$missions = $client->game()->missions();
```

### Rating methods

The `monthly()` method takes 1 **required** parameter `clan` and 2 **optional** parameters: `league` and `page`, the default value of which is `0`.

Returns extended information about current PVE missions: the required completion time is comparable to game rewards, the number of crowns, information about maps, and so on.

```php
$monthly = $client->rating()->monthly('<clan_name>');
```

The `clan()` method does not accept arguments.

Returns information about the clans rating.

```php
$catalog = $client->rating()->clan();
```

The `top100()` accepts an **optional** numeric parameter `class`.

Returns information about the TOP-100 rating of players. When specifying a parameter, it selects a specific game class.

```php
$top100 = $client->rating()->top100();
/**
 * Five game classes are allowed: Rifleman, Medic, Engineer, Sniper, SED
 *
 * @see \Warface\Enums\Classes\Enumeration
 */
$top100 = $client->rating()->top100(\Warface\Enums\Classes\Enumeration::MEDIC);
```

### User methods

The `stat()` method accepts the 1 **required** parameter `nickname` and 1 **optional** parameter `format`.

The `format` parameter interacts with the `full_response` field.

Returns extended information about the player.

```php
/**
 * By default, the value is 0, and the data comes from the API in raw form.
 */
$stat = $client->user()->stat('<nickname>');
/**
 * If you pass the value 1, this field `full_response` will be deleted.
 */
$stat = $client->user()->stat('<nickname>', \Warface\Enums\Filter::REMOVE_RESPONSE_FULL_FIELD);
/**
 * If you pass the value 2, the field `full_response` data will be recursively
 * processed into an array and returned with the main fields.
 *
 * @see Warface\Utils\FullResponse
 */
$stat = $client->user()->stat('<nickname>', \Warface\Enums\Filter::TO_ARRAY_RESPONSE_FULL_FIELD);
```

The `achievements()` method accepts the **required** `nickname` parameter.

Returns extended information about the player's achievements.

```php
$achievements = $client->user()->achievements('<nickname>');
```

### Weapon methods

The `catalog()` method does not accept arguments.

Returns information about game weapons.

```php
$catalog = $client->weapon()->catalog();
```

## License

[MIT](../LICENSE)