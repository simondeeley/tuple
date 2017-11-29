<?php
declare(strict_types=1);
/**
 * This file is part of the Tuple package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tuples;

use simondeeley\Tuple;

/**
 * Concrete implementaion of a pair tuple
 *
 * In use, this class allows you to create a mathematical pair which in PHP
 * terms is an object containing exactly two items. These items can be of any
 * type. Construction in through the 'new' keyword, e.g. $pair = new Pair(1, 2);
 * Once instantiated, access to the objects properties are via an array-type
 * access, such as $value = $pair[1]; Trying to set values this way will result
 * in an exception being thrown.
 *
 * @final
 * @author Simon Deeley <s.deeley@icloud.com>
 */
final class Pair extends Tuple
{
    const MAX_LENGTH = 2;
    const MIN_LENGTH = 2;

    /**
     * Return type of this object
     *
     * @see simondeeley\Type
     * @return string
     */
    final public static function getType(): string
    {
        return 'PAIR';
    }
}
