# Warface API 

Convenient library for working with the Warface API on PHP.

## Prerequisites

| Name  | Version |
|  ---  |   ---   |
|  php  | \>=7.4  |
| ext-curl | *    |
| ext-json | *    |

## Installation

This generator can be installed using Composer by running the following command:

```sh
composer require wnull/warface-api
```

## Example of use

Before using, you should read a documentation about the functions and their parameters. 

```php
require __DIR__ . '/vendor/autoload.php';

$client = new \Warface\ApiClient();
$info = $client->clan()->members('1337', \Warface\Enums\GameServer::ALPHA);

print_r($info);
```

## License

This library is licensed under the [MIT License](https://github.com/wnull/warface-api/blob/master/LICENSE).
