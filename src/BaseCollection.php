<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use RuntimeException;
use Serializable;

/**
 * @template CollectionItem of mixed
 */
abstract class BaseCollection implements ArrayAccess, Countable, Iterator, JsonSerializable, Serializable
{
	/** @phpstan-var list<CollectionItem> */
	private array $storage         = [];
	private int   $storagePosition = 0;

	/**
	 * @phpstan-param CollectionItem ...$values
	 */
	public static function Create(...$values): static
	{
		return new static(...$values);
	}

	/**
	 * @phpstan-param CollectionItem[] $values
	 */
	public static function CreateFromArray(array $values = []): static
	{
		return new static(...$values);
	}

	abstract protected static function IsValueValid(mixed $value): bool;

	/**
	 * @phpstan-param CollectionItem ...$values
	 */
	public function __construct(mixed ...$values)
	{
		$this->add(...$values);
	}

	public function __serialize(): array
	{
		return [
			'storage'         => $this->storage,
			'storagePosition' => $this->storagePosition,
		];
	}

	public function __unserialize(array $data): void
	{
		$this->storage         = $data['storage'] ?? [];
		$this->storagePosition = $data['storagePosition'] ?? 0;
	}

	/**
	 * @phpstan-param CollectionItem ...$values
	 */
	public function add(mixed ...$values): static
	{
		foreach ($values as $value) {
			if (!static::IsValueValid($value)) {
				throw new RuntimeException('Invalid value given (' . gettype($value) . ') for ' . __CLASS__);
			}

			$this->storage[] = $value;
		}

		return $this;
	}

	/**
	 * @phpstan-param (callable(CollectionItem): bool)|null $callback
	 */
	public function filter(callable|null $callback = null): static
	{
		if ($callback === null) {
			return new static(...array_filter($this->storage));
		}

		return new static(...array_filter($this->storage, $callback));
	}

	/**
	 * @phpstan-return CollectionItem|null
	 */
	public function first(): mixed
	{
		if ($this->storage === []) {
			return null;
		}

		return reset($this->storage);
	}

	/**
	 * @phpstan-param CollectionItem $value
	 */
	public function has(mixed $value): bool
	{
		return in_array($value, $this->storage, true);
	}

	/**
	 * @phpstan-return CollectionItem|null
	 */
	public function last(): mixed
	{
		if ($this->storage === []) {
			return null;
		}

		return end($this->storage);
	}

	public function merge(BaseCollection ...$collections): static
	{
		return $this->combine(...$collections);
	}

	public function unique(): static
	{
		return new static(...array_unique($this->storage));
	}

	public function combine(BaseCollection ...$collections): static
	{
		$newCollection = clone $this;
		foreach ($collections as $index => $collection) {
			if (!$collection instanceof static) {
				throw new RuntimeException(static::class . ' expected, ' . get_class($collection) . ' given (index ' . $index . ')');
			}

			$newCollection->add(...$collection->asArray());
		}

		return $newCollection;
	}

	/**
	 * @phpstan-return list<CollectionItem>
	 */
	public function asArray(): array
	{
		return $this->storage;
	}

	/**
	 * @phpstan-param callable(CollectionItem, CollectionItem): int $callback
	 */
	public function sort(callable $callback): static
	{
		$storage = $this->storage;
		usort($storage, $callback);

		return new static(...$storage);
	}

	public function take(int $amount, int $from = 0): static
	{
		return new static(...array_slice(array_values($this->storage), $from, $amount));
	}

	// ArrayAccess implementation

	public function offsetExists($offset): bool
	{
		return isset($this->storage[$offset]);
	}

	/**
	 * @phpstan-return CollectionItem|null
	 */
	public function offsetGet($offset): mixed
	{
		return $this->storage[$offset] ?? null;
	}

	/**
	 * @phpstan-param CollectionItem $value
	 */
	public function offsetSet($offset, $value): void
	{
		if (!$this->IsValueValid($value)) {
			throw new RuntimeException('');
		}

		$this->storage[$offset] = $value;
	}

	public function offsetUnset($offset): void
	{
		unset($this->storage[$offset]);
	}

	// Countable implementation

	public function count(): int
	{
		return count($this->storage);
	}

	// Iterator implementation

	public function rewind(): void
	{
		$this->storagePosition = 0;
	}

	/**
	 * @phpstan-return CollectionItem|null
	 */
	public function current(): mixed
	{
		return $this->storage[$this->storagePosition] ?? null;
	}

	public function key(): int
	{
		return $this->storagePosition;
	}

	public function next(): void
	{
		++$this->storagePosition;
	}

	public function valid(): bool
	{
		return isset($this->storage[$this->storagePosition]);
	}

	// JsonSerializable implementation

	public function jsonSerialize(): array
	{
		return array_map(static function ($value) {
			return (string)$value;
		}, $this->storage);
	}

	// Serializable implementation

	public function serialize(): string|null
	{
		return serialize([$this->storage, $this->storagePosition]);
	}

	public function unserialize($data): void
	{
		[$this->storage, $this->storagePosition] = unserialize($data);
	}
}
