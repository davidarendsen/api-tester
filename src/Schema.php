<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\SchemaSource\SourceInterface;

class Schema {

	protected array $schema;

	public function __construct(SourceInterface $schemaSource) {
		$this->schema = $schemaSource->toArray();
	}

	public function getBaseUri() {
		return $this->schema['base_uri'] ?? '';
	}

	public function getRequests() {
		return $this->schema;
	}

}