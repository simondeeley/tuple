1.1.0
=====
* Add minimum length constraint to enforce Tuples with minimum sizes, or exact sizes by setting the values of `MAX_LENGTH` and `MIN_LENGTH` to the same value.

1.0.1
=====
* Implement a default behaviour compatible with [`Type::getType`](https://github.com/simondeeley/type/blob/master/src/Type/Type.php)

1.0.0
=====
Initial release.

* Provides a base [`Tuple`](../blob/master/src/Tuple.php) class and a new [`TupleType`](../blob/master/Type/TupleType.php) interface (see [simondeeley/type](https://github.com/simondeeley/type)).
* Tuples are by default immutable.
* See [README](../blob/master/README.md) for more information.
