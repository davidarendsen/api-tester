<?php

namespace Arendsen\ApiTester\Schema;

use Arendsen\ApiTester\Matcher;

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

	public function getExpectedValue(): array {
		return $this->testCase['expect'] ?? [];
	}

	public function getMatchers(): array {
		$matchers = [];

		if(!empty($this->getMatcher(Matcher::TO_BE))) {
			$matchers[Matcher::TO_BE] = $this->getMatcher(Matcher::TO_BE);
		}

		if(!empty($this->getMatcher(Matcher::TO_BE_A))) {
			$matchers[Matcher::TO_BE_A] = $this->getMatcher(Matcher::TO_BE_A);
		}

		return $matchers;
	}

	protected function getMatcher(string $matcher): mixed {
		return $this->testCase[$matcher] ?? [];
	}

}