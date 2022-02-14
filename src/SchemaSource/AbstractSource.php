<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;

abstract class AbstractSource implements SourceInterface {

	/**
	 * @var string $extension
	 */
	protected string $extension;

	/**
	 * @var array $sourceArray
	 */
	protected array $sourceArray = [];

	abstract public function parse(string $content): void;

	abstract public function parseFile(string $filename): void;

	public function parseDirectory(string $directory): void {
		$sourceArray = [];

		foreach(glob($directory . '*.' . $this->extension) as $filename) {
			$this->parseFile($filename);
			$sourceArray = array_merge_recursive($sourceArray, $this->toArray());
		}

		$this->parseFile($directory . '.env.' . $this->extension);
		$sourceArray = array_merge_recursive($sourceArray, $this->toArray());

		$this->sourceArray = $sourceArray;
	}

	public function toArray(): array {
		return $this->sourceArray;
	}

}