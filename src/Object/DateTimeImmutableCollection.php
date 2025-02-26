<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Object;

use DateTimeImmutable;
use Xicrow\PhpCollection\BaseCollection;

/**
 * @template-extends BaseCollection<DateTimeImmutable>
 */
class DateTimeImmutableCollection extends DateTimeInterfaceCollection
{
	protected static function IsValueValid($value): bool
	{
		return $value instanceof DateTimeImmutable;
	}
}
