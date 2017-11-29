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

use PHPUnit\Framework\TestCase;
use simondeeley\Type\TupleType;

/**
 * TestCase base object for tuple tests
 *
 * @author Simon Deeley <s.deeley@icloud.com>
 * @uses TestCase
 * @abstract
 */
abstract class TupleTestCase extends TestCase
{
    /**
     * @var string
     */
    protected static $class = null;

    /**
     * Test correct structure of tuple object
     *
     * @dataProvider provideCorrectArguments
     * @test
     * @final
     * @param array $items
     * @return void
     */
    final public function testCorrectStructureOfTupleObject(array $items): void
    {
        $tuple = new static::$class(...$items);

        $this->assertInstanceOf(static::$class, $tuple);
        $this->assertInstanceOf(TupleType::class, $tuple);
        $this->assertTrue($tuple->equals($tuple));

        foreach ($items as $key => $item) {
            $this->assertEquals($item, $tuple[$key]);
        }
    }

    /**
     * Test tuple correctly throws error for too few arguments
     *
     * @test
     * @dataProvider provideTooFewArguments
     * @expectedException LengthException
     * @param array $items
     * @return void
     */
    final public function testExceptionForTooFewArguments(array $items): void
    {
        $tuple = new static::$class(...$items);
    }

    /**
     * Test tuple correctly throws error for too many arguments
     *
     * @test
     * @dataProvider provideTooFewArguments
     * @expectedException LengthException
     * @param array $items
     * @return void
     */
    final public function testExceptionForTooManyArguments(array $items): void
    {
        $tuple = new static::$class(...$items);
    }

    /**
     * Test that an exception is thrown when non-integer offset is requested
     *
     * @test
     * @dataProvider provideCorrectArguments
     * @expectedException InvalidArgumentException
     * @final
     * @param array $items
     * @return void
     */
    final public function testExceptionThrownForNonIntegerOffset(array $items): void
    {
        $tuple = new static::$class(...$items);

        $invalid = $tuple['foo'];
    }

    /**
     * Test that null is returned for out-of-range offsets
     *
     * @test
     * @dataProvider provideCorrectArguments
     * @final
     * @param array $items
     * @return void
     */
    final public function testNullReturnedForInvalidOffset(array $items): void
    {
        $tuple = new static::$class(...$items);

        $this->assertNull($tuple[PHP_INT_MAX]);
        $this->assertNull($tuple[-1]);
    }

    /**
     * Data for tests
     *
     * @return array
     */
    abstract public function provideCorrectArguments(): array;

    /**
     * Data for tests
     *
     * @return array
     */
    abstract public function provideTooFewArguments(): array;

    /**
     * Data for tests
     *
     * @return array
     */
    abstract public function provideTooManyArguments(): array;
}
