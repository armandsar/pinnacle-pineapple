# Pinnacle Pineapple

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/armandsar/pinnacle-pineapple/master.svg?style=flat-square)](https://travis-ci.org/armandsar/pinnacle-pineapple)
[![Total Downloads](https://img.shields.io/packagist/dt/armandsar/pinnacle-pineapple.svg?style=flat-square)](https://packagist.org/packages/armandsar/pinnacle-pineapple)

Simple [pinnacle api](https://pinnacleapi.github.io/) client for Laravel 5.

## Install

Via Composer

``` bash
$ composer require armandsar/pinnacle-pineapple
```

After updating composer, add the ServiceProvider to the providers array in config/app.php

```
Armandsar\PinnaclePineapple\PinnaclePineappleServiceProvider::class,
```

Publish api credentials config

``` bash
$ php artisan vendor:publish
```

## Usage

``` php
$client = new Armandsar\PinnaclePineapple\PinnacleClient();
```

or let Laravel do this by type hinting dependency in constructors or controller methods

## Available methods

Odds:
``` php
$client->odds($options);
```

Special Odds:
``` php
$client->specialOdds($options);
```

Fixtures:
``` php
$client->fixtures($options);
```

Special Fixtures:
``` php
$client->specialFixtures($options);
```

Settled fixtures:
``` php
$client->settledFixtures($options);
```

Leagues:
``` php
$client->leagues($options);
```

Sports:
``` php
$client->sports($options);
```

> $options is just an array for passing in parameters and values to api, for most of the endpoints some sort of parameter will be required

You can also use chainable method since to pass this parameter

``` php
$client->since($when)->odds(['sportId' => 29]);
```

## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
