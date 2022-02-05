<?php

namespace Arendsen\ApiTester;

use Exception;
use Arendsen\ApiTester\SchemaSource\Type;
use Arendsen\ApiTester\SchemaSource\SourceInterface;
use Arendsen\ApiTester\SchemaSource\Yaml;
use Arendsen\ApiTester\SchemaSource\Json;

class SchemaSource {

	public static function create(string $type): SourceInterface {
		switch($type) {
			case Type::YAML:
				return new Yaml();
			case Type::JSON:
				return new Json();
			default:
				throw new Exception('Source type ' . $sourceType . ' does not exist.');
		}
	}

}