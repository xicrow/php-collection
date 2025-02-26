<?php
declare(strict_types=1);

namespace Xicrow\PhpCollection\Scalar;

use Xicrow\PhpCollection\BaseCollection;

/**
 * @template-extends BaseCollection<string>
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

	public function split(string $character = ''): static
	{
		$collection = new static();
		foreach ($this as $string) {
			$collection->add(...explode($character, $string));
		}

		return $collection;
	}
}
