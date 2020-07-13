<?php declare(strict_types=1);
namespace Xicrow\PhpCollection\Scalar;

/**
 * Class IntegerCollection
 *
 * Inherited from BaseCollection
 * @method static IntegerCollection Create(int ...$values)
 * @method static IntegerCollection CreateFromArray(int[] $values = [])
 * @method int[] asArray()
 * @method IntegerCollection add(int ...$values)
 * @method IntegerCollection combine(IntegerCollection ...$collections)
 * @method IntegerCollection filter(?callable $callback = null)
 * @method int|null first()
 * @method int has(int $value)
 * @method int|null last()
 * @method IntegerCollection merge(IntegerCollection ...$collections)
 * @method IntegerCollection sort(callable $callback)
 * @method IntegerCollection take(int $amount, int $from = 0)
 * @method IntegerCollection unique()
 * @method int|null offsetGet($mOffset)
 * @method int|null current()
 *
 * @package Xicrow\PhpCollection\Scalar
 */
class IntegerCollection extends BaseScalarCollection
{
	protected static function IsValueValid($value): bool
	{
		return gettype($value) === 'integer';
	}

	public function average(): float
	{
		if ($this->count() === 0) {
			return 0.0;
		}

		return $this->sum() / $this->count();
	}

	public function sum(): int
	{
		return array_sum($this->asArray());
	}

	public function maximum(): int
	{
		if ($this->count() === 0) {
			return 0;
		}

		return max($this->asArray());
	}

	public function minimum(): int
	{
		if ($this->count() === 0) {
			return 0;
		}

		return min($this->asArray());
	}
}
