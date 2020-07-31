# Warface API [![Latest Stable Version](https://poser.pugx.org/wnull/warface-api/v)](//packagist.org/packages/wnull/warface-api) [![Total Downloads](https://poser.pugx.org/wnull/warface-api/downloads)](//packagist.org/packages/wnull/warface-api) [![License](https://poser.pugx.org/wnull/warface-api/license)](//packagist.org/packages/wnull/warface-api)

Convenient library for working with the Warface API on PHP.

## Prerequisites

| Name       | Version |
|  ---       |   ---   |
| php        | \>=7.4  |
| ext-curl   |    *    |
| ext-json   |    *    |
| ext-libxml |    *    |
| ext-dom    |    *    |

## Installation

This generator can be installed using Composer by running the following command:

```sh
composer require wnull/warface-api
```

## Example of use

Before using, you should read a documentation about the functions and their parameters. 

```php
require __DIR__ . '/vendor/autoload.php';

$client = new Warface\ApiClient();
$info = $client->clan()->members('1337', Warface\Enums\GameServer::ALPHA);

print_r($info);
```

## License

This library is licensed under the [MIT License](https://github.com/wnull/warface-api/blob/master/LICENSE).
