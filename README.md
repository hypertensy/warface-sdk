# Warface  SDK client

Fast and flexible SDK client of the Warface API in PHP.

> During technical weekly work on the game servers, the API may work unstable and give incorrect data.

## References

- [Warface API documentation](https://ru.warface.com/wiki/index.php/API)

## Installation

Via Composer:

```shell
$ composer require wnull/warface-sdk guzzlehttp/guzzle:^7.3 http-interop/http-factory-guzzle:^1.0
```

We are decoupled from any HTTP messaging client with help by [HTTPlug](https://httplug.io/).

## Quickstart

Structure of the client class constructor.

```php
public function __construct(
    \Wnull\Warface\HttpClient\ClientBuilder $httpClientBuilder = null, 
    \Wnull\Warface\Enum\RegionEnum $region = null,
): \Wnull\Warface\Client
```

Create an instance of the client using the following code:

```php
$client = new \Wnull\Warface\Client();
```

When creating a builder, you can add custom plugins to it.

```php
$builder = (new \Wnull\Warface\HttpClient\ClientBuilder());
$builder->addPlugin(
    new class implements \Http\Client\Common\Plugin {
        public function handleRequest(
            \Psr\Http\Message\RequestInterface $request, 
            callable $next, 
            callable $first
        ): \Http\Promise\Promise {
            // TODO: Implement handleRequest() method.
        }
    }
);

$client = new \Wnull\Warface\Client($builder);
```

By default, the `CIS` region is set in the client. It can be changed to `INTERNATIONAL` if necessary.

```php
$builder = null; // builder or null
$client = new \Wnull\Warface\Client($builder, \Wnull\Warface\Enum\RegionEnum::INTERNATIONAL());
```

## Overview

Thanks to [HTTPlug](https://httplug.io), we support the use of many HTTP clients. For example, to use the Symfony HTTP
Client, first install the client and PSR-7 implementation.

```shell
composer require wnull/warface-sdk symfony/http-client nyholm/psr7
```

Next, set up the Warface SDK client with this HTTP client:

```php
$client = \Wnull\Warface\Client::createWithHttpClient(
    new \Symfony\Component\HttpClient\HttplugClient()
);
```

Alternatively, you can inject an HTTP client through the `Client` constructor.

---

For requests that return the status `400`, you can get the response body, not only raw, but also decoded, since the API returns JSON.

```php
try {
    $catalog = (new \Wnull\Warface\Client())->user()->stat('');
} catch (\Wnull\Warface\Exception\WarfaceApiException $e) {
    if ($e instanceof \Wnull\Warface\Exception\BadRequestException) {
        $decodeBody = json_decode($e->getMessage(), true);
        print_r($decodeBody);
    }
}
```

## API

The structure of the application is based solely on the public methods described in the official [docs](#references).

#### Achievement branch

- Method `catalog` returns a complete list of achievements available in the game, with their id and name.

  ```php
  $catalog = (new \Wnull\Warface\Client())->achievement()->catalog();
  ```

#### Clan branch

- Method `members` returns information about the clan.

  ```php
  $members = (new \Wnull\Warface\Client())->clan()->members('<clan>');
  ```

#### Game branch

- Method `missions` returns detailed information about available missions and rewards for completing.

  ```php
  $missions = (new \Wnull\Warface\Client())->game()->missions();
  ```

#### Rating branch

- Method `monthly` returns the monthly rating.

  > If the `$clan` parameter is used, the response from the server will contain data about the selected clan, it will also indicate exactly the league in which this clan is located even if it was not selected in the `$league`.
  >
  > If only the `$league` parameter is used, the server will return the top 100 for that league.

  ```php
  $monthly = (new \Wnull\Warface\Client())
    ->rating()
    ->monthly('?<clan>', \Wnull\Warface\Enum\RatingLeague::ELITE(), '?<page>');
  ```

- Method `clan` returns information about the rating of clans.

  ```php
  $clan = (new \Wnull\Warface\Client())->rating()->clan();
  ```

- Method `top100` returns a TOP-100 rating.

  > If the parameter `$class` is not specified, the data gets for all classes.

  ```php
  $top100 = (new \Wnull\Warface\Client())->rating()->top100(\Wnull\Warface\Enum\GameClass::MEDIC());
  ```

#### User branch

- Method `stat` returns player statistics.

  ```php
  $stat = (new \Wnull\Warface\Client())->user()->stat('<name>');
  ```

- Method `achievements` returns player's achievements.

  ```php
  $achievements = (new \Wnull\Warface\Client())->user()->achievements('<name>');
  ```

#### Weapon branch

- Method `catalog` returns a complete list of items available in the game, with their id and name.

  ```php
  $catalog = (new \Wnull\Warface\Client())->achievement()->catalog();
  ```


## Credits

- [Obraz Solntsa](https://github.com/wnull)
- [All Contributors](https://github.com/wnull/warface-sdk/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.