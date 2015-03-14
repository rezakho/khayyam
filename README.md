## Khayyam
A Simple PHP API Extension For Jalali(Shamsi)/Gregorian Calendar Based On Carbon Extension

[![Build Status](https://travis-ci.org/rezakho/khayyam.svg)](https://travis-ci.org/rezakho/khayyam)
[![Latest Stable Version](https://img.shields.io/packagist/v/rezakho/khayyam.svg?label=release)](https://packagist.org/packages/rezakho/khayyam)
[![Total Downloads](https://img.shields.io/packagist/dt/rezakho/khayyam.svg)](https://packagist.org/packages/rezakho/khayyam)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)
[![License](https://img.shields.io/packagist/l/rezakho/khayyam.svg)](https://packagist.org/packages/rezakho/khayyam)

> **Note:** This Repository Is Not Stable Yet, Don't Use Dev Sources.

```php
//
$tomorrow = Khayyam::now()->addDay();

//
$lastWeek = Khayyam::now()->subWeek();

//
if (Khayyam::now()->isWeekend())
{
	echo 'Go To Tour!';
}

//
echo Khayyam::now()->subMinutes(2)->diffForHumans(); // 'دقیقه پیش ۲'
```

## Installation

### With Composer

```
$ composer require rezakho/khayyam
```

```json
{
    "require": {
        "rezakho/khayyam": "0.1.*@dev"
    }
}
```

```php
require 'vendor/autoload.php';

use Khayyam\Khayyam;

printf("Now: %s", Khayyam::now());
```

<a name="install-nocomposer"/>
### Without Composer

Why are you not using [composer](http://getcomposer.org/)? Download [Khayyam.php](https://github.com/rezakho/Khayyam/blob/master/src/Khayyam/Khayyam.php) from the repo and save the file into your project path somewhere.

```php
require 'path/to/Khayyam.php';

use Khayyam\Khayyam;

printf("Now: %s", Khayyam::now());
```