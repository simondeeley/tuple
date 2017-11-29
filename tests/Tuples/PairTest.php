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

use simondeeley\Tuples\Pair;
use simondeeley\Tests\TupleTestCase;

/**
 * Pair test case
 *
 */
final class PairTest extends TupleTestCase
{
    /**
     * @var string
     */
    protected static $class = Pair::class;

    /**
     * Data for tests
     *
     * @return array
     */
    final public function provideCorrectArguments(): array
    {
        return [
            [[1, 2]],
            [['A', 'B']],
            [[0, 'foo']],
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
            [[1]],
            [['a']],
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
            [['a', 'b', 'c']],
        ];
    }
}
