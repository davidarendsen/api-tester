<?php

namespace Arendsen\ApiTester\Matcher;

use Kahlan\Expectation;
use Arendsen\ApiTester\Matcher;

class Builder {

	/**
	 * @var Expectation $expectation
	 */
	protected Expectation $expectation;

	public function setExpect(mixed $expectedValue) {
		$this->expectation = expect($expectedValue);
	}

	public function addMatcher(string $matcher, $data) {
		if($matcher == Matcher::TO_BE) {
			$this->expectation->toBe($data['value'] ?? '');
		}

		if($matcher == Matcher::TO_BE_A) {
			$this->expectation->toBeA('integer');
		}
	}

	public function match(): Expectation {
		return $this->expectation;
	}

}