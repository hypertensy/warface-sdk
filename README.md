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

This library can be installed using Composer by running the following command:

```sh
composer require wnull/warface-api
```

## Example of use

Before using, you should read a documentation about the functions and their parameters. 

```php
require __DIR__ . '/vendor/autoload.php';

$client = new Warface\ApiClient();

//                               Name clan     Game server (int or const)
//                                  /                    \
$info = $client->clan()->members('1337', Warface\Enums\GameServer::ALPHA);
//                /        \
//             Branch     Method

print_r($info);
```
## Methods

Here you can find the full list of all API Warface methods.

|      Branch/method      |                       Description                        |
|          :---:          |                           ---                            |
| **Achievement**         |                                                          |
| achievement/catalog     | Returns a list of game achievements.                     |
| **Clan**                |                                                          |
| clan/members            | Returns a list of clan members.                          |
| **Game**                |                                                          |
| game/missions           | Returns a list of PVE missions/SO  and rewards for them. |
| **Weapon**              |                                                          |
| weapon/catalog          | Returns a list about the game weapon.                    |
| **Rating**              |                                                          |
| rating/monthly          | Returns information about the monthly rating.            |
| rating/clan             | Returns information about the rating of clans.           |
| rating/top100           | Returns information about the TOP-100 rating.            |
| **User**                |                                                          |
| user/stat               | Returns information about the player.                    |
| user/achievements       | Returns information about the player's achievements.     |

## License

This library is licensed under the [MIT License](https://github.com/wnull/warface-api/blob/master/LICENSE).
