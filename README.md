# Virgool Market PHP API

[![Packagist Version](https://img.shields.io/packagist/v/nekofar/virgool.svg)][1]
[![PHP from Packagist](https://img.shields.io/packagist/php-v/nekofar/virgool.svg)][1]
[![Travis (.com) branch](https://img.shields.io/travis/com/nekofar/virgool-api-php/master.svg)][3]
[![Codecov](https://img.shields.io/codecov/c/gh/nekofar/virgool-api-php.svg)][4]
[![Packagist](https://img.shields.io/packagist/l/nekofar/virgool.svg)][2]

> This is a PHP wrapper for the [Virgool][6] API.

## Installation

This wrapper relies on HTTPlug, which defines how HTTP message should be sent and received. 
You can use any library to send HTTP messages that implements [php-http/client-implementation][5].

```bash
composer require nekofar/virgool:^1.0@dev
```

To install with cURL you may run the following command:

```bash
composer require nekofar/virgool:^1.0@dev php-http/curl-client:^1.0
```

## Usage

Use your username and password to access your own account.

```php
use \Nekofar\Virgool\Client;

$client = Client::create($config)
$client->authenticate('username', 'password');

try {
    $user = $client->getUserInfo();

    echo 'Name: ' . $user->name . PHP_EOL;
    echo 'User: ' . $user->username . PHP_EOL;

} catche (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Contributing

The test suite is built using PHPUnit. Run the suite of unit tests by running
the `phpunit` command or this composer script.

```bash
composer test
```

---
[1]: https://packagist.org/packages/nekofar/virgool
[2]: https://github.com/nekofar/virgool-api-php/blob/master/LICENSE
[3]: https://travis-ci.com/nekofar/virgool-api-php
[4]: https://codecov.io/gh/nekofar/virgool-api-php
[5]: https://packagist.org/providers/php-http/client-implementation
[6]: https://github.com/virgool/docs-api