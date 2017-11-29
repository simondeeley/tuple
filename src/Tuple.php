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
use LengthException;
use simondeeley\Type\Type;
use simondeeley\Type\TupleType;
use simondeeley\Type\TypeEquality;
use simondeeley\ImmutableArrayTypeObject;
use simondeeley\Helpers\TypeEqualityHelperMethods;

/**
 * Tuple base object
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @abstract
 * @uses ImmutableArrayTypeObject
 */
abstract class Tuple extends ImmutableArrayTypeObject implements TupleType, TypeEquality
{
    use TypeEqualityHelperMethods;

    const MAX_LENGTH = PHP_INT_MAX;
    const MIN_LENGTH = 0;

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
     * @throws LengthException - Thrown if number of arguments passed exceeds
     *                           the maximum or is less than the minimum allowed
     *                           values.
     */
    final public function __construct(...$items)
    {
        if (count($items) < static::MIN_LENGTH) {
            throw new LengthException(sprintf(
                '%s expects a minimum of %d arguments but only got %d',
                $this::getType(),
                static::MIN_LENGTH,
                count($items)
            ));
        }

        if (count($items) > static::MAX_LENGTH) {
            throw new LengthException(sprintf(
                '%s expects a maximum of %d arguments but instead got %d',
                $this::getType(),
                static::MAX_LENGTH,
                count($items)
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
     * @param int $flags - optional bitwise flags to change method behaviour
     * @throws InvalidArgumentException - thrown if $tuple is not an instance of
     *                                    TupleType
     * @return bool - Returns true if $tuple is equal to $this
     */
    final public function equals(Type $tuple, int $flags = TypeEquality::IGNORE_OBJECT_IDENTITY): bool
    {
        if (false === $tuple instanceof TupleType)
        {
            throw new InvalidArgumentException(sprintf(
                'Cannot compare %s with %s as they are not of the same type',
                get_class($this),
                get_class($tuple)
            ));
        }

        if (0 === strcmp(
                md5(serialize($this->data->toArray())),
                md5(serialize($tuple->data->toArray())))
            && $this->isSameTypeAs($tuple, $flags)
            && $this->isSameObjectAs($tuple, $flags)
        ) {
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
        if (false === is_int($offset)) {
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

    /**
     * Implement a basic getType
     *
     * @return string
     */
    public static function getType(): string
    {
        return 'TUPLE';
    }
}
