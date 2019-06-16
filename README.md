# Uuid

[![Travis CI](https://api.travis-ci.org/qlimix/uuid.svg?branch=master)](https://travis-ci.org/qlimix/uuid)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/uuid.svg)](https://coveralls.io/qlimix/uuid)
[![Packagist](https://img.shields.io/packagist/v/qlimix/uuid.svg)](https://packagist.org/packages/qlimix/uuid)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/uuid/blob/master/LICENSE)

A Uuid value object and an interface to generate an uuid.

## Install

Using Composer:

~~~
$ composer require qlimix/uuid
~~~

## usage
```php
<?php

use Qlimix\Id\Uuid\Uuid;

$uuid = new Uuid('ecf72764-f657-4ae9-9183-135b72bbad32');
$uuid2 = new Uuid('ecf72764-f657-4ae9-9183-135b72bbad32');

$bytes = $uuid->getBytes();
$string = $uuid->toString();

$uuid = Uuid::fromBytes($bytes);

if ($uuid->equals($uuid2)) {
    // the same
}

```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
