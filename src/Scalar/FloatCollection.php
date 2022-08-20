<?php
declare(strict_types=1);
namespace Xicrow\PhpCollection\Scalar;

/**
 * Class FloatCollection
 *
 * Inherited from BaseCollection
 * @method static FloatCollection Create(float ...$values)
 * @method static FloatCollection CreateFromArray(float[] $values = [])
 * @method float[] asArray()
 * @method FloatCollection add(float ...$values)
 * @method FloatCollection combine(FloatCollection ...$collections)
 * @method FloatCollection filter(?callable $callback = null)
 * @method float|null first()
 * @method float has(float $value)
 * @method float|null last()
 * @method FloatCollection merge(FloatCollection ...$collections)
 * @method FloatCollection sort(callable $callback)
 * @method FloatCollection take(int $amount, int $from = 0)
 * @method FloatCollection unique()
 * @method float|null offsetGet($mOffset)
 * @method float|null current()
 *
 * @package Xicrow\PhpCollection\Scalar
 */
class FloatCollection extends BaseScalarCollection
{
	protected static function IsValueValid($value): bool
	{
		return gettype($value) === 'float' || gettype($value) === 'double';
	}

	public function average(): float
	{
		if ($this->count() === 0) {
			return 0.0;
		}

		return $this->sum() / $this->count();
	}

	public function sum(): float
	{
		return array_sum($this->asArray());
	}

	public function maximum(): float
	{
		if ($this->count() === 0) {
			return 0;
		}

		return max($this->asArray());
	}

	public function minimum(): float
	{
		if ($this->count() === 0) {
			return 0;
		}

		return min($this->asArray());
	}
}
