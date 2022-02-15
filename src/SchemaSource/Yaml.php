<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;
use Symfony\Component\Yaml\Yaml as YamlComponent;

class Yaml extends AbstractSource {

	/**
	 * @var string $extension
	 */
	protected string $extension = 'yaml';

	protected function parse(string $content): void {
		$sourceArray = YamlComponent::parse($content);
		$this->addToSourceArray($sourceArray);
	}

}