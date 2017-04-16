# Stopwatch

[![Build Status][ico-build]][link-build]
[![Code Quality][ico-code-quality]][link-code-quality]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Latest Version][ico-version]][link-packagist]
[![PDS Skeleton][ico-pds]][link-pds]

## Installation

The preferred method of installation is via [Composer](http://getcomposer.org/). Run the following command to install the latest version of a package and add it to your project's `composer.json`:

```bash
composer require djuricmilos/stopwatch
```

## Usage

``` php
$stopwatch = Stopwatch::createNew();
$stopwatch->start();
$stopwatch->getElapsedMilliseconds();
$stopwatch->stop();
```

## Credits

- [All Contributors][link-contributors]

## License

Released under MIT License - see the [License File](LICENSE) for details.

[ico-version]: https://img.shields.io/packagist/v/djuricmilos/stopwatch.svg
[ico-build]: https://travis-ci.org/djuricmilos/stopwatch.svg?branch=master
[ico-code-coverage]: https://img.shields.io/scrutinizer/coverage/g/djuricmilos/stopwatch.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/djuricmilos/stopwatch.svg
[ico-pds]: https://img.shields.io/badge/pds-skeleton-blue.svg

[link-packagist]: https://packagist.org/packages/djuricmilos/stopwatch
[link-build]: https://travis-ci.org/djuricmilos/stopwatch
[link-code-coverage]: https://scrutinizer-ci.com/g/djuricmilos/stopwatch/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/djuricmilos/stopwatch
[link-pds]: https://github.com/php-pds/skeleton
[link-author]: https://github.com/djuricmilos
[link-contributors]: ../../contributors
