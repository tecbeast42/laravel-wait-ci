# Wait for your storage and database to be reachable in ci

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tecbeast42/laravel-wait-ci.svg?style=flat-square)](https://packagist.org/packages/tecbeast42/laravel-wait-ci)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/tecbeast42/laravel-wait-ci/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tecbeast42/laravel-wait-ci/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/tecbeast42/laravel-wait-ci/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/tecbeast42/laravel-wait-ci/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/tecbeast42/laravel-wait-ci.svg?style=flat-square)](https://packagist.org/packages/tecbeast42/laravel-wait-ci)

<img src="./logo-laravel-wait-ci.png" alt="Logo laravel wait ci" height="200">

Artisan command to wait for your storage and database to be reachable in ci

You can use option parameter with a comma seperatet list for database (`--db-connentions=mysql,pgsql`) and storage (`--storage-disks=laravel,public` ).

## Installation

You can install the package via composer:

```bash
composer require --dev tecbeast42/laravel-wait-ci
```

## Usage

```bash
php artisan ci:wait {--db-connentions=mysql,pgsql} {--storage-disks=laravel,public}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tobias Kriebisch](https://github.com/tecbeast42)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
