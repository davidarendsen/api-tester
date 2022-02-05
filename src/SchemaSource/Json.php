<?php

namespace Arendsen\ApiTester\SchemaSource;

class Json extends AbstractSource {

	public function parse(string $content): void {
		$this->sourceArray = json_decode($content, true);
	}

	public function parseFile(string $filename): void {
		$file = file_get_contents($filename);
		$this->sourceArray = json_decode($file, true);
	}

}