<?php
declare(strict_types=1);
/**
 * This file is part of the Tuple package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley;

use SplFixedArray;
use InvalidArgumentException;
use OutOfRangeException;
use simondeeley\Type\Type;
use simondeeley\Type\TupleType;
use simondeeley\Type\TypeEquality;
use simondeeley\ImmutableArrayTypeObject;

/**
 * Tuple base object
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @abstract
 * @uses ImmutableArrayTypeObject
 */
abstract class Tuple extends ImmutableArrayTypeObject implements TupleType, TypeEquality
{
    const MAX_LENGTH = PHP_INT_MAX;

    /**
     * @var SplFixedArray $data
     */
    protected $data;

    /**
     * Create a new tuple object
     *
     * Instantiates a new tuple object of fixed length with the provided data
     * set. Once the object is created, it's contents cannot be mutated.
     *
     * @param mixed ...$items - Variadic number of arguments
     * @return void
     * @throws OutOfRangeException - Thrown if number of arguments passed
     *                               exceeds maximum allowed amount
     */
    final public function __construct(...$items)
    {
        if (count($items) > static::MAX_LENGTH) {
            throw new OutOfRangeException(sprintf(
                'Size of %s exceeds the maximum of %d items',
                get_class($this),
                static::MAX_LENGTH
            ));
        }

        $this->data = SplFixedArray::fromArray($items);
    }

    /**
     * Check two Tuples are equal
     *
     * Compares the internal data of the two tuple objects ($tuple & $this). It
     * runs each through a comparitor which serializes each value, if one is
     * not equal to the other then the result will be considered false.
     *
     * @param Type $tuple - The tuple to compare
     * @return bool - Returns true if $tuple is equal to $this
     */
    final public function equals(Type $tuple): bool
    {
        if (false === $tuple instanceof TupleType)
        {
            throw new InvalidArgumentException(sprintf(
                'Cannot compare %s with %s as they are not of the same type',
                get_class($this),
                get_class($tuple)
            ));
        }

        if (0 === count(
            array_udiff(
                $this->data->toArray(),
                $tuple->data->toArray(),
                function($a, $b): int {
                    return (int) strcmp(md5(serialize($a)), md5(serialize($b)));
                })
            ))
        {
            return true;
        }

        return false;
    }

    /**
     * Check that a property exists
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset - Name of the property to check
     * @return bool - Returns true if property exists
     * @throws InvalidArgumentException - Thrown if $property is not an integer
     */
    final public function offsetExists($offset): bool
    {
        if (is_nan($offset)) {
            throw new InvalidArgumentException(sprintf(
                'Offset must be of type integer, "%s" passed',
                 gettype($offset)
            ));
        }

        return isset($this->data[$offset]);
    }

    /**
     * ArrayAccess get offset
     *
     * @param mixed $offset
     * @return mixed
     */
    final public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }
}
