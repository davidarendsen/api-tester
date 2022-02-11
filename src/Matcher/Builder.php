<?php

namespace Arendsen\ApiTester\Matcher;

use Exception;
use Kahlan\Expectation;
use Arendsen\ApiTester\Matcher;

class Builder {

	/**
	 * @var Expectation $expectation
	 */
	protected Expectation $expectation;

	public function setActualValue(mixed $actualValue) {
		$this->expectation = expect($actualValue);
	}

	/**
	 * @throws Exception
	 */
	public function addMatcher(string $matcher, mixed $data) {
		switch($matcher) {
			case Matcher::TO_BE:
				$this->expectation->toBe($data['value'] ?? '');
			break;
			case Matcher::TO_BE_A:
				$this->expectation->toBeA($data);
			break;
			default:
				throw new Exception('Could not find matcher ' . $matcher);
		}
	}

	public function match(): Expectation {
		return $this->expectation;
	}

}