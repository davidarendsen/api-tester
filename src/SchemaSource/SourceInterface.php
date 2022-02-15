<?php

namespace Arendsen\ApiTester\SchemaSource;

interface SourceInterface {

	public function parseFile(string $filename): void;

	public function parseDirectory(string $directory): void;

	public function parseEnvironmentVariablesFile(string $filename): void;

	public function toArray(): array;

}