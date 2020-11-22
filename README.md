# Warface API 

[![Build Status](https://travis-ci.com/wnull/warface-api.svg?branch=master)](https://travis-ci.com/wnull/warface-api)
[![Monthly Downloads](https://poser.pugx.org/wnull/warface-api/d/monthly)](//packagist.org/packages/wnull/warface-api)
[![License](https://poser.pugx.org/wnull/warface-api/license)](//packagist.org/packages/wnull/warface-api)

Convenient library for working with the Warface API on PHP.

## Prerequisites

|    Name    | Version |
|    ---     |  :---:  |
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

//                         (the clan name, the ID of the game server)
//                                  /                    \
$info = $client->clan()->members('1337', Warface\Enums\GameServer::ALPHA);
//                /        \
//             Branch     Method

print_r($info);
```

## Methods

Here you can find the full list of all API Warface methods.

<table>
  <thead>
    <tr>
      <th>Branch</th>
      <th>Method</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>achievement</td>
      <td>catalog</td>
      <td>Returns a list of game achievements</td>
    </tr>
    <tr>
      <td>clan</td>
      <td>members</td>
      <td>Returns a list of clan members</td>
    </tr>
    <tr>
      <td rowspan="3">rating</td>
      <td>monthly</td>
      <td>Returns info about the monthly rating</td>
    </tr>
    <tr>
      <td>clan</td>
      <td>Returns info about the rating of clans</td>
    </tr>
    <tr>
      <td>top100</td>
      <td>Returns info about the TOP-100 rating</td>
    </tr>
    <tr>
      <td>weapon</td>
      <td>catalog</td>
      <td>Returns a list about the game weapon</td>
    </tr>
    <tr>
      <td rowspan="2">user</td>
      <td>stat</td>
      <td>Returns info about the player</td>
    </tr>
    <tr>
      <td>achievements</td>
      <td>Returns info about the player achievements</td>
    </tr>
	<tr>
	  <td>game</td>
	  <td>missions</td>
	  <td>Returns a list of PVE missions/SO  and rewards for them</td>
	</tr>
  </tbody>
</table>

## License

This library is licensed under the [MIT License](https://github.com/wnull/warface-api/blob/master/LICENSE).