<?php
declare(strict_types=1);
/**
 * This file is part of the Tuple package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

namespace simondeeley\Tests;

use simondeeley\Tuple;
use InvalidArgumentException;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

/**
 * Unit test Tuple object
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @uses TestCase
 * @final
 */
final class TupleTest extends TestCase
{
    /**
     * Test correct instantiation of a tuple
     *
     * @test
     * @final
     * @return void
     */
    final public function instantiateTuple(): void
    {
        $this->assertInstaceOf(Tuple::class, new _testTuple(1, 2, 3, 4));
    }

    /**
     * Test correctly instantiates with less than max items
     *
     * @test
     * @final
     * @return void
     */
    final public function instantiateWithLessThanMax(): void
    {
        $this->assertInstaceOf(Tuple::class, new _testTuple(1,2,3));
    }

    /**
     * Test throws Exception
     *
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Size of _testTuple exceeds the maximum of 4 items
     * @final
     * @return void
     */
    final public function shouldThrowException(): void
    {
        $invalid = new _testTuple(1,2,3,4,5,6);
    }

    /**
     * Test correctly confirms offset valid and invalid
     *
     * @test
     * @final
     * @return void
     */
    final public function testOffsetExists(): void
    {
        $tuple = new _testTuple(1,2,3,4);

        $this->assertTrue(isset($tuple[2]));
        $this->assertFalse(isset($tuple[10]));
    }

    /**
     * Test exception thrown when non-integer is passed
     *
     * @test
     * @dataProvider invalidOffsets
     * @expectedException InvalidArgumentException
     * @final
     * @param mixed $offset - the offset to test
     * @return void
     */
    final public function testInvalidOffsets($offset): void
    {
        $tuple = new _testTuple(1,2,3,4);

        $this->expectExceptionMessage(sprintf(
            'Offset must be of type integer, "%s" passed',
             gettype($offset)
        ));

        isset($tuple[$offset]);
    }

    /**
     * Test correctly fetches offsets
     *
     * @test
     * @dataProvider validOffsets
     * @final
     * @param int $offset - Offset to fetch
     * @param mixed $expected - the expected value
     * @return void
     */
    final public function testFetchesOffsets(int $offset, $expected): void
    {
        $tuple = new _testTuple('foo', 'bar', 10, null);

        $this->assertEquals($expected, $tuple[$offset]);
    }

    /**
     * Test equality of two tuples
     *
     * @test
     * @dataProvider equalityProvider
     * @final
     * @param Tuple $one - first tuple
     * @param Tuple $two - second tuple
     * @param bool $expected - The result expected
     * @return void
     */
    final public function testEquality(Tuple $one, Tuple $two, bool $expected): void
    {
        $this->assert($expected, $one->equals($two));
    }

    /**
     * Data provider for invalid offsets
     *
     * @final
     * @return array
     */
    final public function invalidOffsets(): array
    {
        return [
            ['string'],
            [new stdClass()],
            [log(0)],
            [true],
            [null]
        ];
    }

    /**
     * Data provider for valid offsets
     *
     * @final
     * @return array
     */
    final public function validOffsets(): array
    {
        return [
            [0, 'foo'],
            [1, 'bar'],
            [2, 10],
            [3, null]
        ];
    }

    /**
     * Data provider for equality test
     *
     * @final
     * @return array
     */
    final public function equalityProvider(): array
    {
        return [
            [new _testTuple(1,2,3), new _testTuple(1,2,3), true],
            [new _testTuple(1,2,3), new _testTuple(3,2,1), false],
            [new _testTuple(1,2,3), new _testTuple(1,2,3,4), false],
            [new _testTuple('a'), new _testTuple('A'), false],
            [new _testTuple(1), new _testTuple('1'), false],
            [new _testTuple(true, false), new _testTuple(true, false), true],
            [new _testTuple(false, false), new _testTuple(true, false), false]
        ];
    }
}

/**
 * Test tuple
 *
 */
final class _testTuple extends Tuple {
    const MAX_LENGTH = 4;
}
