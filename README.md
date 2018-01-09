# DevOp Config

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Simple library to process your configuration parameters

## Install

Via Composer

``` bash
$ composer require devop-core/config
```

## Usage

``` php
<?php
use DevOp\Core\Config;

include_once './vendor/autoload.php';

$config = new Config('./config/config.php', 'dev', 'env.php');

var_dump($config->get('database.password', 'test')); // get specific configuration option

var_dump($config->all()); // get all configurations
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Zlatin Hristov](https://z-latko.info)
- [All Contributors](https://github.com/devop-core/config/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/devop-core/config.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/devop-core/config/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/devop-core/config.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/devop-core/config.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/devop-core/config.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/devop-core/config
[link-travis]: https://travis-ci.org/devop-core/config
[link-scrutinizer]: https://scrutinizer-ci.com/g/devop-core/config/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/devop-core/config
[link-downloads]: https://packagist.org/packages/devop-core/config
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
