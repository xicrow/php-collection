<?php declare(strict_types=1);
namespace Xicrow\PhpCollection;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use RuntimeException;
use Serializable;

/**
 * Class BaseCollection
 *
 * Template for subclasses (replace tags, and remove space in "@ method"):
 *     Inherited from BaseCollection
 *     @ method static <COLLECTION_CLASS> Create(<VALUE_TYPE> ...$values)
 *     @ method static <COLLECTION_CLASS> CreateFromArray(<VALUE_TYPE>[] $values = [])
 *     @ method <VALUE_TYPE>[] asArray()
 *     @ method <COLLECTION_CLASS> add(<VALUE_TYPE> ...$values)
 *     @ method <COLLECTION_CLASS> combine(<COLLECTION_CLASS> ...$collections)
 *     @ method <COLLECTION_CLASS> filter(?callable $callback = null)
 *     @ method <VALUE_TYPE>|null first()
 *     @ method <VALUE_TYPE> has(<VALUE_TYPE> $value)
 *     @ method <VALUE_TYPE>|null last()
 *     @ method <COLLECTION_CLASS> merge(<COLLECTION_CLASS> ...$collections)
 *     @ method <COLLECTION_CLASS> sort(callable $callback)
 *     @ method <COLLECTION_CLASS> take(int $amount, int $from = 0)
 *     @ method <COLLECTION_CLASS> unique()
 *     @ method <VALUE_TYPE>|null offsetGet($mOffset)
 *     @ method <VALUE_TYPE>|null current()
 *
 * @package Xicrow\PhpCollection
 */
abstract class BaseCollection implements ArrayAccess, Countable, Iterator, JsonSerializable, Serializable
{
	private array $storage         = [];
	private int   $storagePosition = 0;

	public function __construct(...$values)
	{
		$this->add(...$values);
	}

	public function add(...$values): self
	{
		foreach ($values as $value) {
			if (!static::IsValueValid($value)) {
				throw new RuntimeException('Invalid value given (' . gettype($value) . ') for ' . __CLASS__);
			}

			$this->storage[] = $value;
		}

		return $this;
	}

	abstract protected static function IsValueValid($value): bool;

	public static function Create(...$values): self
	{
		return new static(...$values);
	}

	public static function CreateFromArray(array $values = []): self
	{
		return new static(...$values);
	}

	public function filter(?callable $callback = null): self
	{
		if ($callback === null) {
			return new static(...array_filter($this->storage));
		}

		return new static(...array_filter($this->storage, $callback));
	}

	public function first()
	{
		if ($this->storage === []) {
			return null;
		}

		return reset($this->storage);
	}

	public function has($value): bool
	{
		return array_search($value, $this->storage, true) !== false;
	}

	public function last()
	{
		if ($this->storage === []) {
			return null;
		}

		return end($this->storage);
	}

	public function merge(BaseCollection ...$collections): self
	{
		return $this->combine(...$collections)->unique();
	}

	public function unique(): self
	{
		return new static(...array_unique($this->storage));
	}

	public function combine(BaseCollection ...$collections): self
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

	public function asArray(): array
	{
		return $this->storage;
	}

	public function sort(callable $callback): self
	{
		$storage = $this->storage;
		usort($storage, $callback);

		return new static(...$storage);
	}

	public function take(int $amount, int $from = 0): self
	{
		return new static(...array_slice(array_values($this->storage), $from, $amount));
	}

	// ArrayAccess implementation

	public function offsetExists($mOffset): bool
	{
		return isset($this->storage[$mOffset]);
	}

	public function offsetGet($mOffset)
	{
		return $this->storage[$mOffset] ?? null;
	}

	public function offsetSet($mOffset, $value): void
	{
		if (!$this->IsValueValid($value)) {
			throw new RuntimeException('');
		}

		$this->storage[$mOffset] = $value;
	}

	public function offsetUnset($mOffset): void
	{
		unset($this->storage[$mOffset]);
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

	public function current()
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

	public function serialize()
	{
		return serialize([$this->storage, $this->storagePosition]);
	}

	public function unserialize($serialized)
	{
		[$this->storage, $this->storagePosition] = unserialize($serialized);
	}
}
