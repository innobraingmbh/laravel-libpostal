# Libpostal for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/innobrain/laravel-libpostal.svg?style=flat-square)](https://packagist.org/packages/innobrain/laravel-libpostal)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/innobraingmbh/laravel-libpostal/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/innobraingmbh/laravel-libpostal/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/innobraingmbh/laravel-libpostal/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/innobraingmbh/laravel-libpostal/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/innobrain/laravel-libpostal.svg?style=flat-square)](https://packagist.org/packages/innobrain/laravel-libpostal)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require innobraingmbh/laravel-libpostal
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-libpostal-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('LIBPOSTAL_URL', 'http://localhost:8080'),
];
```

## Usage

```php
use Innobrain\Libpostal\Facades\Libpostal;

Libpostal::parseAddress('123 Main St, Springfield, IL 62701');
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

- [Bruno Görß](https://github.com/Katalam)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
