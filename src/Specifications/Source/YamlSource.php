<?php

namespace Arendsen\ApiTester\Specifications\Source;

use Symfony\Component\Yaml\Yaml;

class YamlSource extends AbstractSource {

	public function parse(string $content): void {
		$this->sourceArray = Yaml::parse($content);
	}

	public function parseFile(string $filename): void {
		$this->sourceArray = Yaml::parseFile($filename);
	}

}