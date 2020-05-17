# Web Driver [![Build Status][icon-status]][link-status] [![Total Downloads][icon-downloads]][link-downloads] [![MIT License][icon-license]](LICENSE.md)

Run and/or control a web driver programmatically.

- [Requirements](#requirements)
- [Install](#install)
- [Usage](#usage)
  - [Chrome Web Driver](#chrome-web-driver)
  - [Phantomjs Web Driver](#phantomjs-web-driver)
- [API](#api)
  - [Example](#example)
- [Advanced](#advanced)
- [Changelog](#changelog)
- [Testing](#testing)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Requirements

- PHP >= 5.6.4

## Install

You may install this package using [composer][link-composer].

```shell
$ composer require bhittani/web-driver --prefer-dist
```

## Usage

This package conveniently wraps the [Facebook's PHP Web Driver](https://github.com/php-webdriver/php-webdriver) and by default offers drivers for chrome and phantomjs.

### Chrome Web Driver

```php
<?php

use Bhittani\WebDriver\Chrome as ChromeDriver;

$driver = ChromeDriver::make('/path/to/chrome/driver/binary');
```

### Phantomjs Web Driver

```php
<?php

use Bhittani\WebDriver\Phantomjs as PhantomjsDriver;

$driver = PhantomjsDriver::make('/path/to/phantomjs/driver/binary');
```

## API

All driver instances extend `Facebook\WebDriver\Remote\RemoteWebDriver`, hence, the same API applies.

### Example

```php
<?php

$googleDotCom = $driver->get('https://google.com');

$googleDotCom->getTitle(); // 'Google'
```

## Advanced

[ ] Document the usage of process.
[ ] Document the usage of custom ports.
[ ] Document the usage of payload (chrome)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed.

## Testing

```sh
git clone https://github.com/kamalkhan/web-driver

cd web-driver

composer install

composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email `shout@bhittani.com` instead of using the issue tracker.

## Credits

- [Kamal Khan](http://bhittani.com)
- [All Contributors](https://github.com/kamalkhan/web-driver/contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.

<!--Status-->

[icon-status]: https://img.shields.io/github/workflow/status/kamalkhan/web-driver/main?style=flat-square

[link-status]: https://github.com/kamalkhan/web-driver

<!--Downloads-->

[icon-downloads]: https://img.shields.io/packagist/dt/bhittani/web-driver.svg?style=flat-square

[link-downloads]: https://packagist.org/packages/bhittani/web-driver

<!--License-->

[icon-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

<!--composer-->

[link-composer]: https://getcomposer.org
