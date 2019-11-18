pop-filter
==========

[![Build Status](https://travis-ci.org/popphp/pop-filter.svg?branch=master)](https://travis-ci.org/popphp/pop-filter)
[![Coverage Status](http://cc.popphp.org/coverage.php?comp=pop-filter)](http://cc.popphp.org/pop-filter/)

OVERVIEW
--------
`pop-filter` is a component for applying filtering callbacks to multiple values that need
to be consumed by other areas of an application. It can be used for input security as well
general input clean-up as well. 

`pop-filter` is a component of the [Pop PHP Framework](http://www.popphp.org/).

INSTALL
-------

Install `pop-filter` using Composer.

    composer require popphp/pop-filter

BASIC USAGE
-----------

### Simple Filter

If you want to create a simple, single filter and use it to filter some values, you can do this:

```php
$filter = new Pop\Filter\Filter('strip_tags');
$values = [
    'username' => '<b>admin</b>',
    'email'    => '<a href="mailto:test@test.com">test@test.com</a>'
];
$values = $filter->filter($values);
```

The values above have been filtered and had the tags stripped:

```text
$values = [
    'username' => 'admin',
    'email'    => 'test@test.com'
];
```

### The Abstract Filterable Class

The component comes with an abstract class called `Pop\Filter\AbstractFilterable`. If you
wish to have the filter component and its features wired into your application, you will
need to have a class that extends this abstract class. With it, your class will be able
to add filters and call the methods to filter the necessary values.

```php
namespace MyApp\Model

use Pop\Filter\AbstractFilterable;

class User extends AbstractFilterable
{

    /**
     * Filter values
     *
     * @param  array $values
     * @return array
     */
    public function filter(array $values)
    {
        foreach ($this->filters as $filter) {
            foreach ($values as $key => $value) {
                $values[$key] = $filter->filter($value, null, $key);
            }
        }

        return $values;
    }

} 
```

With the above code, you can create a user model, add filters to it
and filter values with it:

```php
$user = new User();
$user->addFilters([
    new Pop\Filter\Filter('strip_tags', null, null, 'username'),
    new Pop\Filter\Filter('htmlentities', [ENT_QUOTES, 'UTF-8']),
]);

$values = [
    'username'   => '<script>"Admin"</script>',
    'first_name' => '<b>John\'s</b>',
    'last_name'  => '<b>Doe</b>'
];

$values = $user->filter($values);
```

The values are now filtered and look like:

```text
$values = [
    'username'   => '&quot;Admin&quot;',
    'first_name' => 'John&#039;s',
    'last_name'  => 'Doe'
];
```

The tags have been stripped and the entities have been converted to HTML.

### Fine-Grained Control

Two properties are available to the `filter` method within the `Pop\Filter\AbstractFilter` class.
They are `excludeByName` and `excludeByType`. With them, you can have fine-tuned control over
what values actually get filtered. For example, if you don't want to filter any values named
`username`, you can do this:

```php
$filter = new Pop\Filter\Filter('strip_tags', null, 'username');
$values = [
    'username' => '<b>admin</b>',
    'email'    => '<a href="mailto:test@test.com">test@test.com</a>'
];

foreach ($values as $key => $value) {
    $values[$key] = $filter->filter($value, $key);
}
```

Because of the third parameter in the above constructor, the `username` is excluded from being
filtered and the values look like this:

```text
$values = [
    'username' => '<b>admin</b>',
    'email'    => 'test@test.com'
];
```

The fourth parameter of the filter constructor is `$excludeByType` and that is useful for
excluding a number of values at once that are all of the same type, for example, textareas
within a form object.