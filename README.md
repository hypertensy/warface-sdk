# Warface API SDK client

[![Travis (.org)](https://img.shields.io/travis/wnull/warface-api?style=flat-square&color=%23228B22)](https://travis-ci.com/wnull/warface-api) 
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/wnull/warface-api?style=flat-square) 
![Standard](https://img.shields.io/badge/Standard-PSR--12-blueviolet?style=flat-square)

A fast, convenient and easy library for working with the Warface API written in PHP.

> ### The near future
> 
> If you are using PHP version `8.2` or higher, you can try using a new, more flexible and faster version of the client in a new [branch](https://github.com/wnull/warface-sdk/tree/5.x). You can read more in the [issue](https://github.com/wnull/warface-sdk/issues/12). The merger of the branches is planned for the beginning of 2024.

## References

- [Warface API documentation](https://ru.warface.com/wiki/index.php/API)

## Installation

Via Composer:

```shell
$ composer require wnull/warface-sdk
```

## Initialization

Create `WarfaceClient` object using the following code:

```php
use Warface\Client as WarfaceClient;

$client = new WarfaceClient(); // default is CIS
```

Also, you can initialize `WarfaceClient` with different region like this:

```php
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;

$client = new WarfaceClient(Region::CIS); 
$client = new WarfaceClient(Region::INTERNATIONAL);
```

## Extra

Additional features of the application client.

### Bypass timeout response 

A request control system is enabled for the CIS region. Two or more identical requests running in a row cause a long response or timeout from the API. In rare cases, error `429` is returned.

In order to enable the workaround of this problem, pass a special flag to the `Client` constructor.

```php
use Warface\Client as WarfaceClient;
use Warface\Enums\Location\Region;

$client = new WarfaceClient(Region::CIS, true);
```


### Notice

- In May 2022, the API switched to the `HTTPS` protocol, you need to keep this in mind.
- During weekly maintenance work, sometimes API methods return an invalid response body. To avoid problems, use error catching with [`ValidationException`](src/Exceptions/ValidationException.php).


### Proxy

You can configure the proxy server for requests, change even during iteration.

```php
use Warface\Client as WarfaceClient;

$client = new WarfaceClient(); 
$client->setProxy('{ip:port}', '?{login:password}');
```
### Catching bad requests

You can set a flag `$throwOnBadRequest` that will allow you to throw an exception [`RequestException`](src/Exceptions/RequestException.php) if the response came with the status `400`.

```php
use Warface\Client as WarfaceClient;
use Warface\Exceptions\RequestException;

$client = new WarfaceClient();
$client::$throwOnBadRequest = true;

try {
    $client->user()->stat('');
} catch (RequestException $e) {
    echo $e->getMessage();
}
```

## API

The structure of the application is based solely on the public methods described in the official [docs](#references).

### Achievement branch

- Method `catalog` returns a complete list of achievements available in the game, with their id and name.

  ```php
  use Warface\Client as WarfaceClient;
  
  $catalog = (new WarfaceClient())->achievement()->catalog();
  ```

### Clan branch

- Method `members` returns information about the clan.

  ```php
  use Warface\Client as WarfaceClient;
  
  $members = (new WarfaceClient())->clan()->members('{clan_name}');
  ```

### Game branch

- Method `missions` returns detailed information about available missions and rewards for completing.

  ```php
  use Warface\Client as WarfaceClient;
  
  $missions = (new WarfaceClient())->game()->missions();
  ```

### Rating branch

- Method `monthly` returns the monthly rating.

  > If the `$clan` parameter is used, the response from the server will contain data about the selected clan, it will also indicate exactly the league in which this clan is located even if it was not selected in the `$league`.
  >
  > If only the `$league` parameter is used, the server will return the top 100 for that league.

  ```php
  use Warface\Client as WarfaceClient;
  use Warface\Enums\League;
  
  $monthly = (new WarfaceClient())
    ->rating()
    ->monthly('?{clan_name}', League::ELITE_LEAGUE, '?{page}');
  ```

- Method `clan` returns information about the rating of clans.

  ```php
  use Warface\Client as WarfaceClient;
  
  $clan = (new WarfaceClient())->rating()->clan();
  ```

- Method `top100` returns a TOP-100 rating.

  > If the parameter `$class` is not specified, the data gets for all classes.

  ```php
  use Warface\Client as WarfaceClient;
  use Warface\Enums\Classes\Enumeration;
  
  $top100 = (new WarfaceClient())->rating()->top100(Enumeration::SED);
  ```

### User branch

- Method `stat` returns player statistics.

   > An additional parameter `$formatFullResponse` can be passed a flag that will mutate the field of `full_response`.

  ```php
  use Warface\Client as WarfaceClient;
  
  $stat = (new WarfaceClient())->user()->stat('{name}', '?{formatFullResponse}');
  ```

- Method `achievements` returns player's achievements.

  ```php
  use Warface\Client as WarfaceClient;
  
  $achievements = (new WarfaceClient())->user()->achievements('{name}');
  ```

### Weapon branch

- Method `catalog` returns a complete list of items available in the game, with their id and name.

  ```php
  use Warface\Client as WarfaceClient;
  
  $catalog = (new WarfaceClient())->achievement()->catalog();
  ```

## License

[MIT](LICENSE)

