# Laravel Conta Azul Integration Package
This package provides a simple and elegant way to integrate Laravel applications with Conta Azul's API, offering an easy-to-use service and facade.

<p align="center">
 <a href="https://github.com/EliseuSantos/laravel-contaazul/actions?query=workflow%3ATests"><img src="https://github.com/EliseuSantos/laravel-contaazul/workflows/Tests/badge.svg" style="max-width:100%;"  alt="tests badge"></a>
 <a href="https://packagist.org/packages/eliseusantos/laravel-contaazul"><img src="https://img.shields.io/packagist/v/EliseuSantos/laravel-contaazul.svg?style=flat-square" alt="version badge"/></a>
 <a href="https://packagist.org/packages/eliseusantos/laravel-contaazul"><img src="https://img.shields.io/packagist/dt/EliseuSantos/laravel-contaazul.svg?style=flat-square" alt="downloads badge"/></a>
</p>

## Features

- Easy integration with Conta Azul API.
- Laravel ServiceProvider for easy registration.
- Facade for convenient access to the service.
- Customizable through Laravel configuration files.

## Requirements

- PHP >= 8.3
- Laravel >= 10

## Installation

1. Require the package using Composer:

```bash
composer require eliseusantos/laravel-contaazul
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="EliseuSantos\ContaAzul\Providers\ContaAzulServiceProvider"
```

This command publishes the `contaazul.php` configuration file to your Laravel application's `config` directory.

## Configuration

After publishing the configuration file, you can find it at `config/contaazul.php`. You'll need to set your Conta Azul API credentials here:

```php
CONTA_AZUL_BASE_URI="https://api.contaazul.com"
CONTA_AZUL_CLIENT_ID="your_token_here"
CONTA_AZUL_CLIENT_TOKEN="your_token_here"
```

Add these lines to your `.env` file and replace `"your_token_here"` with your actual Conta Azul API token.

## Usage

After setting up your configuration, you can use the Conta Azul service throughout your Laravel application. Here's an example of listing customers using the Conta Azul facade:

```php
use EliseuSantos\ContaAzul\Facades\ContaAzul as ContaAzul;

$customers = ContaAzul::customer()->getCustomers();
```

## Support us

We invest a lot in creating [open source packages](https://macsidigital.co.uk/open-source), and would be grateful for a [sponsor](https://github.com/sponsors/MacsiDigital) if you make money from your product that uses them.

## Updates & Issues

We only accept Issues through [Github](https://github.com/EliseuSantos/laravel-contaazul)

We update security and bug fixes as soon as we can, other pull requests and enhancements will be as and when we can do them.

You can follow us on Linkedin where we will post any major updates. [Linkedin](https://www.linkedin.com/in/eliseusantos)
You can follow us on Twitter where we will post any major updates. [Twitter](https://twitter.com/Eliseu__Santos)
You can follow us on Blog where we will post any major updates. [Site](https://infoneeded.ghost.io)

## To Do's

- Documentation Site
- Tests

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email [s.eliseu@proton.me](mailto:info@macsi.co.uk) instead of using the issue tracker.

## Credits

- [EliseuSantos](https://github.com/EliseuSantos)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
