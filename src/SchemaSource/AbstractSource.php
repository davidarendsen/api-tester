<?php

namespace Arendsen\ApiTester\SchemaSource;

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