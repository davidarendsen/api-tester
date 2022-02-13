<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;

class Json extends AbstractSource {

	/**
	 * @var string $extension
	 */
	protected string $extension = 'json';

	public function parse(string $content): void {
		$this->sourceArray = json_decode($content, true);
	}

	public function parseFile(string $filename): void {
		if(!file_exists($filename)) {
			throw new Exception('Source file ' . $filename . ' does not exist!');
		}

		$file = file_get_contents($filename);
		$this->sourceArray = json_decode($file, true);
	}

}