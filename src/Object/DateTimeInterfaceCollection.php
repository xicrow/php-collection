<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Object;

use DateTime;
use DateTimeInterface;
use Xicrow\PhpCollection\BaseCollection;
use Xicrow\PhpCollection\Scalar\IntegerCollection;
use Xicrow\PhpCollection\Scalar\StringCollection;

/**
 * @template-extends BaseCollection<DateTimeInterface>
 */
class DateTimeInterfaceCollection extends BaseObjectCollection
{
	protected static function IsValueValid($value): bool
	{
		return $value instanceof DateTimeInterface;
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

	public function filterToAfter(DateTimeInterface $dateTime): static
	{
		return $this->filter(static function (DateTimeInterface $value) use ($dateTime): bool {
			return $value->getTimestamp() > $dateTime->getTimestamp();
		});
	}

	public function filterToBefore(DateTimeInterface $dateTime): static
	{
		return $this->filter(static function (DateTimeInterface $value) use ($dateTime): bool {
			return $value->getTimestamp() < $dateTime->getTimestamp();
		});
	}

	public function firstDate(): DateTimeInterface|null
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

	public function lastDate(): DateTimeInterface|null
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

	public function sortAscending(): static
	{
		return $this->sort(static function (DateTime $a, DateTime $b): int {
			return $a->getTimestamp() <=> $b->getTimestamp();
		});
	}

	public function sortDescending(): static
	{
		return $this->sort(static function (DateTime $a, DateTime $b): int {
			return $b->getTimestamp() <=> $a->getTimestamp();
		});
	}
}
