<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Object;

use DateTime;
use Xicrow\PhpCollection\BaseCollection;

/**
 * @template-extends BaseCollection<DateTime>
 */
class DateTimeCollection extends DateTimeInterfaceCollection
{
	protected static function IsValueValid($value): bool
	{
		return $value instanceof DateTime;
	}
}
