# Warface  SDK client

Fast and flexible SDK client of the Warface API in PHP.

> **Important**: during technical weekly work on the game servers, the API may work unstable and give incorrect data.

## References

- [Warface API documentation](https://ru.warface.com/wiki/index.php/API)

## Installation

Via Composer:

```shell
$ composer require wnull/warface-sdk guzzlehttp/guzzle:^7.3 http-interop/http-factory-guzzle:^1.0
```

We are decoupled from any HTTP messaging client with help by [HTTPlug](https://httplug.io/).

## Quickstart

Create an instance of the client using the following code:

```php
$client = new \Wnull\Warface\Client();
```
The constructor includes two parameters: the first is the client class builder, the second is the host API region. You can make your the builder and fill it with custom plugins.

```php
$builder = (new \Wnull\Warface\HttpClient\ClientBuilder());
$builder->addPlugin(
    new class implements \Http\Client\Common\Plugin {
        public function handleRequest(
            \Psr\Http\Message\RequestInterface $request, 
            callable $next, 
            callable $first)
        : \Http\Promise\Promise {
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
$client = \Worksome\SDK\Client::createWithHttpClient(
    new \Symfony\Component\HttpClient\HttplugClient()
);
```

Alternatively, you can inject an HTTP client through the `Client` constructor.

---

For requests that return the status `400`, if an opportunity is needed, then you can process the error body, since requests also return json data.

```php
try {
    $catalog = (new \Wnull\Warface\Client())->weapon()->catalog();
} catch (\Wnull\Warface\Exception\WarfaceApiException $e) {
    if ($e instanceof \Wnull\Warface\Exception\BadRequestException) {
        $rawBody = $e->getMediator()->getResponse()->getBody()->getContents(); // raw body
        $decodeBody = $e->getMediator()->getBodyContentsDecode(); // array decode body with reason
    }
}
```

## API

Below are all kinds of public methods for working with API.

```php
$client = new \Wnull\Warface\Client();

// Achievement branch
$achievement = $client->achievement();
$catalog = $achievement->catalog();

// Clan branch
$clan = $client->clan();
$members = $clan->members('<clan_name>');

// Game branch
$game = $client->game();
$missions = $game->missions();

// Rating branch
$rating = $client->rating();
$clan = $rating->clan();
// All options params
$monthly = $rating->monthly('?<clan>', \Wnull\Warface\Enum\RatingLeague::BRONZE(), '?<page>')
$top100 = $rating->top100(\Wnull\Warface\Enum\GameClass::ENGINEER());

// User branch
$user = $client->user();
$stat = $user->stat('<name>');
$achievements = $user->achievements('<name>');

// Weapon branch
$weapon = $client->weapon();
$catalog = $weapon->catalog();
```

## Credits

- [Obraz Solntsa](https://github.com/wnull)
- [All Contributors](https://github.com/wnull/warface-sdk/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.