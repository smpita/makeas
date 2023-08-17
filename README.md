# Typed Container Resolver for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smpita/makeas.svg?style=flat-square)](https://packagist.org/packages/smpita/makeas)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smpita/makeas/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smpita/makeas/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smpita/makeas/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smpita/makeas/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smpita/makeas.svg?style=flat-square)](https://packagist.org/packages/smpita/makeas)

- Do you fight the `mixed` signature of `app()->make()` when resolving objects?
- Do you want to effortlessly guarantee the resolved object is the expected object? 
- Do you use static analysis on your [Laravel](https://laravel.com/) app?

[MakeAs](https://github.com/smpita/makeas) will make sure you make the object you expect, and nicely type the return for static analysis.

## Installation

You can install the package via composer:

```bash
composer require smpita/makeas
```

## Usage

If you bound the object to the class-string
```php
$typed = app()->makeAs(Bound::class);
```

Of course you can pass in parameters
```php
$typed = app()->makeAs(Bound::class, []);
```

If you bound the object with a magic string
```php
$typed = app()->makeAs('magic-string', [], Bound::class);
```

## Signature
```php
makeAs(string $abstract, array $parameters = [], string $expected = null): mixed
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

- [Sean Pearce](https://github.com/smpita)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
