<?php

declare(strict_types=1);

namespace Serens\TypedCollection\Tests;

use PHPUnit\Framework\TestCase;
use Serens\TypedCollection\Collection;

final class CollectionTest extends TestCase
{
    public function testCollectionCanBeCreatedWithItems(): void
    {
        $testData = [1, 2, 3];
        $collection = new Collection($testData);

        $this->assertEquals($testData, $collection->toArray());
    }

    public function testCollectionCanBeExtendedWithMoreItems(): void
    {
        $a = [1, 2, 3];
        $b = [4, 5, 6];
        $collection = new Collection($a);
        $collection->addItems($b);

        $this->assertEquals(6, $collection->count());
        $this->assertEquals([...$a, ...$b], $collection->toArray());
    }

    public function testHelperFunctionsCanBeUsed(): void
    {
        $testData = [1, 2, 3];
        $collection = new Collection($testData);

        $this->assertEquals(3, $collection->count());
        $this->assertEquals(1, $collection->getFirst());
        $this->assertEquals(2, $collection->getElement(1));
        $this->assertEquals(3, $collection->getLast());

        $this->expectException(\OutOfBoundsException::class);
        $collection->getElement(342);
    }

    public function testGettingFirstThrowExceptionWhenCollectionIsEmpty(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        (new Collection())->getFirst();
    }

    public function testGettingLastThrowExceptionWhenCollectionIsEmpty(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        (new Collection())->getLast();
    }

    public function testCollectionCanBeUsedAsAnArray(): void
    {
        $collection = new Collection();
        $collection[] = 1;
        $collection[] = 2;
        $collection[] = 3;

        $this->assertEquals([1, 2, 3], $collection->toArray());
    }

    public function testCollectionIsAlwaysIndexed(): void
    {
        $testData = ['a' => 1, 'b' => 2, 'c' => 3];
        $collection = new Collection($testData);

        $this->assertEquals(array_values($testData), $collection->toArray());
    }
}
