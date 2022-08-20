<?php
declare(strict_types=1);
namespace Xicrow\PhpCollection\Object;

use DateTime;
use Xicrow\PhpCollection\Scalar\IntegerCollection;
use Xicrow\PhpCollection\Scalar\StringCollection;

/**
 * Class DateTimeCollection
 *
 * Inherited from BaseCollection
 * @method static DateTimeCollection Create(DateTime ...$values)
 * @method static DateTimeCollection CreateFromArray(DateTime[] $values = [])
 * @method DateTime[] asArray()
 * @method DateTimeCollection add(DateTime ...$values)
 * @method DateTimeCollection combine(DateTimeCollection ...$collections)
 * @method DateTimeCollection filter(?callable $callback = null)
 * @method DateTime|null first()
 * @method DateTime has(DateTime $value)
 * @method DateTime|null last()
 * @method DateTimeCollection merge(DateTimeCollection ...$collections)
 * @method DateTimeCollection sort(callable $callback)
 * @method DateTimeCollection take(int $amount, int $from = 0)
 * @method DateTimeCollection unique()
 * @method DateTime|null offsetGet($mOffset)
 * @method DateTime|null current()
 *
 * @package Xicrow\PhpCollection\Object
 */
class DateTimeCollection extends BaseObjectCollection
{
	protected static function IsValueValid($value): bool
	{
		return $value instanceof DateTime;
	}

	public function asIntegerCollection(): IntegerCollection
	{
		$values = [];
		foreach ($this as $dateTime) {
			$values[] = $dateTime->getTimestamp();
		}

		return IntegerCollection::CreateFromArray($values);
	}

	public function asStringCollection(string $format = 'Y-m-d H:i:s'): StringCollection
	{
		$values = [];
		foreach ($this as $dateTime) {
			$values[] = $dateTime->format($format);
		}

		return StringCollection::CreateFromArray($values);
	}

	public function filterToAfter(DateTime $dateTime): self
	{
		return $this->filter(static function (DateTime $value) use ($dateTime): bool {
			return $value->getTimestamp() > $dateTime->getTimestamp();
		});
	}

	public function filterToBefore(DateTime $dateTime): self
	{
		return $this->filter(static function (DateTime $value) use ($dateTime): bool {
			return $value->getTimestamp() < $dateTime->getTimestamp();
		});
	}

	public function firstDate(): ?DateTime
	{
		if ($this->count() === 0) {
			return null;
		}

		$firstDate = null;
		foreach ($this as $dateTime) {
			if ($firstDate === null || $dateTime->getTimestamp() < $firstDate->getTimestamp()) {
				$firstDate = $dateTime;
			}
		}

		return $firstDate;
	}

	public function lastDate(): ?DateTime
	{
		if ($this->count() === 0) {
			return null;
		}

		$lastDate = null;
		foreach ($this as $dateTime) {
			if ($lastDate === null || $dateTime->getTimestamp() > $lastDate->getTimestamp()) {
				$lastDate = $dateTime;
			}
		}

		return $lastDate;
	}

	public function sortAscending(): self
	{
		return $this->sort(static function (DateTime $a, DateTime $b): int {
			return $a->getTimestamp() <=> $b->getTimestamp();
		});
	}

	public function sortDescending(): self
	{
		return $this->sort(static function (DateTime $a, DateTime $b): int {
			return $b->getTimestamp() <=> $a->getTimestamp();
		});
	}
}
