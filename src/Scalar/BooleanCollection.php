<?php
declare(strict_types=1);
namespace Xicrow\PhpCollection\Scalar;

/**
 * Class BooleanCollection
 *
 * Inherited from BaseCollection
 * @method static BooleanCollection Create(bool ...$values)
 * @method static BooleanCollection CreateFromArray(bool[] $values = [])
 * @method bool[] asArray()
 * @method BooleanCollection add(bool ...$values)
 * @method BooleanCollection combine(BooleanCollection ...$collections)
 * @method BooleanCollection filter(?callable $callback = null)
 * @method bool|null first()
 * @method bool has(bool $value)
 * @method bool|null last()
 * @method BooleanCollection merge(BooleanCollection ...$collections)
 * @method BooleanCollection sort(callable $callback)
 * @method BooleanCollection take(int $amount, int $from = 0)
 * @method BooleanCollection unique()
 * @method bool|null offsetGet($mOffset)
 * @method bool|null current()
 *
 * @package Xicrow\PhpCollection\Scalar
 */
class BooleanCollection extends BaseScalarCollection
{
	protected static function IsValueValid($value): bool
	{
		return gettype($value) === 'boolean';
	}
}
