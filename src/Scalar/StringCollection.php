<?php
declare(strict_types=1);
namespace Xicrow\PhpCollection\Scalar;

/**
 * Class StringCollection
 *
 * Inherited from BaseCollection
 * @method static StringCollection Create(string ...$values)
 * @method static StringCollection CreateFromArray(string[] $values = [])
 * @method string[] asArray()
 * @method StringCollection add(string ...$values)
 * @method StringCollection combine(StringCollection ...$collections)
 * @method StringCollection filter(?callable $callback = null)
 * @method string|null first()
 * @method string has(string $value)
 * @method string|null last()
 * @method StringCollection merge(StringCollection ...$collections)
 * @method StringCollection sort(callable $callback)
 * @method StringCollection take(int $amount, int $from = 0)
 * @method StringCollection unique()
 * @method string|null offsetGet($mOffset)
 * @method string|null current()
 *
 * @package Xicrow\PhpCollection\Scalar
 */
class StringCollection extends BaseScalarCollection
{
	protected static function IsValueValid($value): bool
	{
		return gettype($value) === 'string';
	}

	public function join(string $character = ''): string
	{
		return implode($character, $this->asArray());
	}

	public function split(string $character = ''): self
	{
		$collection = new static();
		foreach ($this as $string) {
			$collection->add(...explode($character, $string));
		}

		return $collection;
	}
}
