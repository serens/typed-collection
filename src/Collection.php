<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

use OutOfBoundsException;

/**
 * A simple implementation of interfaces \Iterator, \Countable and \ArrayAccess.
 * Additionally, adds some basic helper functions.
 */
class Collection implements \Iterator, \Countable, \ArrayAccess
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        $this->setItems($items);
    }

    public function setItems(array $items): void
    {
        $this->items = array_values($items);
    }

    public function addItems(array $items): void
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(mixed $item): void
    {
        $this->items[] = $item;
    }

    public function getFirst(): mixed
    {
        if (empty($this->items)) {
            throw new OutOfBoundsException('Collection is empty.');
        }

        return $this->items[0];
    }

    /**
     * @throws OutOfBoundsException If given index is out of bounds
     */
    public function getElement(int $index): mixed
    {
        if ($index < 0 || $index > $this->count() - 1) {
            throw new OutOfBoundsException('Index ['.$index.'] out of valid boundaries.');
        }

        return $this->items[$index];
    }

    public function getLast(): mixed
    {
        if (empty($this->items)) {
            throw new OutOfBoundsException('Collection is empty.');
        }

        return $this->items[$this->count() - 1];
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function key(): mixed
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function valid(): bool
    {
        return false !== $this->current();
    }

    public function current(): mixed
    {
        return current($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[(int)$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[(int)$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->items[(int)$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[(int)$offset]);
    }
}
