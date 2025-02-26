<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Scalar;

use Xicrow\PhpCollection\BaseCollection;

/**
 * @template-extends BaseCollection<int>
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
