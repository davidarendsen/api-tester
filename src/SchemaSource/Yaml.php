<?php

namespace Arendsen\ApiTester\SchemaSource;

use Symfony\Component\Yaml\Yaml as YamlComponent;

class Yaml extends AbstractSource {

	public function parse(string $content): void {
		$this->sourceArray = YamlComponent::parse($content);
	}

	public function parseFile(string $filename): void {
		$this->sourceArray = YamlComponent::parseFile($filename);
	}

}