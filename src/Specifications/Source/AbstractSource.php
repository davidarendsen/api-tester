<?php

namespace Arendsen\ApiTester\Specifications\Source;

use Exception;

abstract class AbstractSource implements SourceInterface {

	/**
	 * @var array $sourceArray
	 */
	protected array $sourceArray;

	abstract public function parse(string $content): void;

	abstract public function parseFile(string $filename): void;

	public function toArray(): array {
		return $this->sourceArray;
	}

}