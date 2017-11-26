<?php
declare(strict_types=1);
/**
 * This file is part of the Non Nullable package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Type;

use simondeeley\Type\ImmutableType;

/**
 * Tuple type object
 *
 * A Tuple is a mathematical term describing a set of objects of a specified
 * length. Once a tuple has been instantiated its length or contents cannot be
 * varied without creating a new tuple.
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 */
interface TupleType extends ImmutableType
{

}
