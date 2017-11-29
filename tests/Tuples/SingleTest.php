<?php
declare(strict_types=1);
/**
 * This file is part of the Tuple package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tests\Tuples;

use simondeeley\Tuples\Single;
use simondeeley\Tests\TupleTestCase;

/**
 * Single test case
 *
 */
final class SingleTest extends TupleTestCase
{
    /**
     * @var string
     */
    protected static $class = Single::class;

    /**
     * Data for tests
     *
     * @return array
     */
    final public function provideCorrectArguments(): array
    {
        return [
            [[1]],
            [['A']],
            [[ [1,2,3,4] ]],
        ];
    }

    /**
     * Data for tests
     *
     * @return array
     */
    final public function provideTooFewArguments(): array
    {
        return [
            [[]],
        ];
    }

    /**
     * Data for tests
     *
     * @return array
     */
    final public function provideTooManyArguments(): array
    {
        return [
            [[1, 2, 3]],
            [['a', 'b']],
        ];
    }
}
