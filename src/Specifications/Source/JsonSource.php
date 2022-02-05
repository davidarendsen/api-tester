<?php

namespace Arendsen\ApiTester\Specifications\Source;

class JsonSource extends AbstractSource {

	public function parse(string $content): array {
		return json_decode($content, true);
	}

	public function parseFile(string $filename) {
		$file = file_get_contents($filename);
		return json_decode($file, true);
	}

}