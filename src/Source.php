<?php

namespace Arendsen\ApiTester;

use Exception;
use Arendsen\ApiTester\Specifications\Source\SourceType;
use Arendsen\ApiTester\Specifications\Source\SourceInterface;
use Arendsen\ApiTester\Specifications\Source\YamlSource;
use Arendsen\ApiTester\Specifications\Source\JsonSource;

class Source {

	public function create(string $sourceType): SourceInterface {
		switch($sourceType) {
			case SourceType::YAML:
				return new YamlSource();
			case SourceType::JSON:
				return new JsonSource();
			default:
				throw new Exception('Source type ' . $sourceType . ' does not exist.');
		}
	}

}