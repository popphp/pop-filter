pop-filter
==========

[![Build Status](https://travis-ci.org/popphp/pop-filter.svg?branch=master)](https://travis-ci.org/popphp/pop-filter)
[![Coverage Status](http://cc.popphp.org/coverage.php?comp=pop-filter)](http://cc.popphp.org/pop-filter/)

END OF LIFE
-----------
The `pop-filter` component v2.1.0 is now end-of-life and will no longer be supported due
to lack of use.

OVERVIEW
--------
`pop-filter` is a component for simple filtering and manipulation of strings.
It provides features like generating URL slugs, random strings, web links
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

You can give it a separator to further control the format of the URL slug:

```php
echo Pop\Filter\Slug::filter("About Us | Company | President", ' | ');
```

    about-us/company/president

### Generating a random string

```php
use Pop\Filter\Random;
echo Random::create(8, Random::ALPHANUM|Random::LOWERCASE);
```

    sjd873k3

The above example generates a random, lowercase 8-character alphanumeric string.

### Generating hyper links

```php
$text = <<<TEXT
www.popphp.org is a website.
Another website is http://www.google.com/
An email address is test@test.com.
TEXT;

echo Pop\Filter\Links::filter($text);
```

    <a href="http://www.popphp.org">www.popphp.org</a> is a website.
    Another website is <a href="http://www.google.com/">http://www.google.com/</a>
    An email address is <a href="mailto:test@test.com">test@test.com</a>.

The above example filters the text with the proper hyper links around
the text that matches the proper patterns. That includes:

* Web or FTP links
    + This includes domains with http, https, ftp or no protocol.
* Email addresses

### Converting case

```php
echo Pop\Filter\ConvertCase::underscoreToCamelcase('myapp_table_users');
```

    MyTableUsers

```php
echo Pop\Filter\ConvertCase::camelCaseToSeparator('MyTableUsers');
```

    My/Table/Users

