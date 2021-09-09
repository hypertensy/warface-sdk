# Warface API Client 
[![Travis (.org)](https://img.shields.io/travis/wnull/warface-api)](https://travis-ci.com/wnull/warface-api)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/wnull/warface-api)

A fast Warface API client with all available game methods.

## Installation

Via Composer:

```shell
$ composer require wnull/warface-api
```

## Using

To change the location, you need to pass the desired value to the class constructor. By default, there is a location for CIS.
```php
$client = new Warface\Client(Warface\Enums\Locale::CIS); // Russian servers
$client = new Warface\Client(Warface\Enums\Locale::INTERNATIONAL); // Europe servers
```

A simple example of the `stat()` method.

```php
<?php

require __DIR__ . './vendor/autoload.php';

$client = new Warface\Client();
$user = $client->user()->stat('Элез');

print_r($user);
```

## Branches and methods

- [Achievement](src/Methods/Achievement.php)
  ```php
  $catalog = (new Warface\Client())->achievement()->catalog();
  ```
 
- [Clan](src/Methods/Clan.php)
  ```php
  $members = (new Warface\Client())->clan()->members('Репулс');
  ```
 
- [Game](src/Methods/Game.php)
  ```php
  $missions = (new Warface\Client())->game()->missions();
  ```

- [Rating](src/Methods/Rating.php)
  ```php
  $monthly = (new Warface\Client())->rating()->monthly('Манул');

  $clan = (new Warface\Client())->rating()->clan();

  $top100 = (new Warface\Client())->rating()->top100();
  ```

- [User](src/Methods/User.php)
  ```php
  $stat = (new Warface\Client())->user()->stat('Элез');

  $achievements = (new Warface\Client())->user()->achievements('Блогер');
  ```

- [Weapon](src/Methods/Weapon.php)
  ```php
  $catalog = (new Warface\Client())->weapon()->catalog();
  ```


## License

[MIT](LICENSE)


