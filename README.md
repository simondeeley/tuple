Reusable tuple object for PHP
==================================

[![Build Status](https://travis-ci.org/simondeeley/tuple.svg?branch=master)](https://travis-ci.org/simondeeley/tuple) [![Latest Stable Version](https://poser.pugx.org/simondeeley/tuple/v/stable)](https://packagist.org/packages/simondeeley/tuple) [![Total Downloads](https://poser.pugx.org/simondeeley/tuple/downloads)](https://packagist.org/packages/simondeeley/tuple) [![Latest Unstable Version](https://poser.pugx.org/simondeeley/tuple/v/unstable)](https://packagist.org/packages/simondeeley/tuple) [![License](https://poser.pugx.org/simondeeley/tuple/license)](https://packagist.org/packages/simondeeley/tuple)

This package provides a tuple type object for PHP. It is based off [simondeeley\Type](https://github.com/simondeeley/type) package which provides immutable objects.

> In [mathematics](https://en.wikipedia.org/wiki/Mathematics) a **tuple** is a finite ordered list (sequence) of [elements](https://en.wikipedia.org/wiki/Element_(mathematics)). An **_n_-tuple** is a [sequence](https://en.wikipedia.org/wiki/Sequence) (or ordered list) of _n_ elements, where _n_ is a non-negative integer.
>
> –_[Wikipedia](https://en.wikipedia.org/wiki/Tuple)_

An example of a tuple could be `[1, 2, 3, 4, 5]`. The order of the items in a tuple is important, so given a set of 'A' being `[1, 2, 3]` and 'B' also being `[1, 2, 3]` then it's true that A equals B. However if we have another set 'C' which is `[3, 2, 1]` then this is not equal to A (or B).

This package was born out of a love creating beautifully crafted 'boilerplate' code which can be reused again and again in any number of both simple and complex objects. Most of the ideas used in this package revolve around the need to create the most basic of PHP objects - one that is immutable and unchanging. Trouble is, PHP has a fair few 'magic methods' which, although great for method overriding, are less great for ensuring an immutable state. This package aims to solve that problem and provide a number of base classes to allow you to build easy-to-use immutable classes of your own.

Requirements
============

* PHP >= 7.1.0

Installation
============

```
composer require simondeeley/tuple
```

Usage
=====

Create your own tuple object

```php
use simondeeley\Tuple;

class MyTuple extends Tuple
{
    //...
}
```

This is the starting point to creating a tuple. By default you can have any number of items in your tuple object (up to the limit of PHP's [PHP_INT_MAX](http://php.net/manual/en/reserved.constants.php) value). You can override this and create your own maximum length tuples.

Let's go ahead and create a simple tuple called a pair. Unsurprisingly this has a maximum of two items.

```php
use simondeeley\Tuple;

class Pair extends Tuple
{
    const MAX_LENGTH = 2;
}
```

Now we have our new class we can create pair-type objects until out hearts content...
```php
$numeric = new Pair(1, 2);
$strings = new Pair('A', 'B');
$mixed = new Pair(1024, 'FooBar');
$objects = new Pair($numeric, $strings);
```

Testing Equality
================

The base tuple implements the  [`TypeEquality`](https://github.com/simondeeley/type/blob/master/src/Type/TypeEquality.php) interface from the [simondeeley\Type](https://github.com/simondeeley/type) package. Using this equality check we can compare two tuples. Following on from our Pair example above we can do the following

```php
$foo = new Pair(1, 2);
$bar = new Pair(1, 2);
$baz = new Pair(2, 1);

$foo->equals($bar); // Returns true
$foo->equals($baz); // Returns false
```

Explore the source code to see how the comparisons are made or to see how the base tuple class is built.
