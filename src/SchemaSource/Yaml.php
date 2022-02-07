<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;
use Symfony\Component\Yaml\Yaml as YamlComponent;

class Yaml extends AbstractSource {

	public function parse(string $content): void {
		$this->sourceArray = YamlComponent::parse($content);
	}

	public function parseFile(string $filename): void {
		if(!file_exists($filename)) {
			throw new Exception('Source file ' . $filename . ' does not exist!');
		}

		$this->sourceArray = YamlComponent::parseFile($filename);
	}

}