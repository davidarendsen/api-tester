<?php

namespace Arendsen\ApiTester\Schema;

class TestCase {

	/**
	 * @var array $testCase
	 */
	protected array $testCase;

	public function __construct(array $testCase) {
		$this->testCase = $testCase;
	}

	public function getDescription(): string {
		return $this->testCase['description'] ?? '';
	}

	public function getExpect(): array {
		return $this->testCase['expect'] ?? [];
	}

	public function getToBe(): array {
		return $this->testCase['toBe'] ?? [];
	}

	public function getToBeA(): string {
		return $this->testCase['toBeA'] ?? '';
	}

}