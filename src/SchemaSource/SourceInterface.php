<?php

namespace Arendsen\ApiTester\SchemaSource;

interface SourceInterface {

	public function parse(string $content): void;

	public function parseFile(string $filename): void;

	public function toArray(): array;

}