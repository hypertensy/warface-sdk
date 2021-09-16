# Warface API SDK for PHP [![Travis (.org)](https://img.shields.io/travis/wnull/warface-api)](https://travis-ci.com/wnull/warface-api) ![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/wnull/warface-api)

A fast Warface API SDK library.

## Installation

Via Composer:

```shell
$ composer require wnull/warface-api
```

## Using

To change the location, you need to pass the desired value to the class constructor. The default location is the CIS.
```php
$client = new Warface\Client(Warface\Enums\Locale::CIS); // Russian servers
$client = new Warface\Client(Warface\Enums\Locale::INTERNATIONAL); // Europe servers
```

## Branches and methods with examples
```php
# Init client
$client = new Warface\Client();

# Achievement branch
$catalog = $client->achievement()->catalog();

# Clan branch
$members = $client->clan()->members('<clan_name>');

# Game branch
$missions = $client->game()->missions();

# Rating branch
$monthly = $client->rating()->monthly('<clan_name>');
$clan = $client->rating()->clan();
$top100 = $client->rating()->top100();

# User branch
$stat = $client->user()->stat('<nickname>');
$achievements = $client->user()->achievements('<nickname>');

# Weapon branch
$catalog = $client->weapon()->catalog();
```

## License

[MIT](LICENSE)


