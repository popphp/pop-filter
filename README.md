pop-filter
==========

[![Build Status](https://travis-ci.org/popphp/pop-filter.svg?branch=master)](https://travis-ci.org/popphp/pop-filter)
[![Coverage Status](http://www.popphp.org/cc/coverage.php?comp=pop-filter)](http://www.popphp.org/cc/pop-filter/)

OVERVIEW
--------
`pop-filter` is a component for simply filtering and manipulation of strings.
It mostly provides features like generating URL slugs, random strings, web links
and case conversion.

`pop-filter`is a component of the [Pop PHP Framework](http://www.popphp.org/).

INSTALL
-------

Install `pop-filter` using Composer.

    composer require popphp/pop-filter

BASIC USAGE
-----------

### Generating a URL slug

```php
echo Pop\Filter\Slug::filter("Hello World What's Up?");
```

    hello-world-whats-up

### Generating a random string

```php
use Pop\Filter\Random;
echo Random::create(8, Random::ALPHANUM|Random::LOWERCASE);
```

    sjd873k3

The above example generates a random lowercase alphanumeric string

### Generating hyper links

```php
$text = <<<TEXT
www.popphp.org is a website.
An email address is test@test.com.
TEXT;

echo Pop\Filter\Links::filter($text);
```

    <a href="http://www.popphp.org">www.popphp.org</a> is a website.
    An email address is <a href="mailtot:test@test.com">test@test.com</a>.

The above example filters the text with the proper hyper links around
the text that matches that pattern.

### Converting case

```php
echo Pop\Filter\ConvertCase::underscoreToCamelcase('myapp_table_users');
```

    MyTableUsers

```php
echo Pop\Filter\ConvertCase::camelCaseToSeparator('MyTableUsers');
```

    My/Table/Users

