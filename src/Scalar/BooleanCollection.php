<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Scalar;

use Xicrow\PhpCollection\BaseCollection;

/**
 * @template-extends BaseCollection<bool>
 */
class BooleanCollection extends BaseScalarCollection
{
	protected static function IsValueValid($value): bool
	{
		return gettype($value) === 'boolean';
	}
}
