<?php

namespace Arendsen\ApiTester;

use Kahlan\Expectation;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher\Builder;

class Matcher {

	const TO_BE = 'toBe';
	const TO_BE_A = 'toBeA';

	/**
	 * @var TestCase $testCase
	 */
	protected TestCase $testCase;

	/**
	 * @var HttpResponse $httpResponse
	 */
	protected HttpResponse $httpResponse;

	public function __construct(TestCase $testCase, HttpResponse $httpResponse) {
		$this->testCase = $testCase;
		$this->httpResponse = $httpResponse;
	}

	public function match(): Expectation {
		$expect = $this->testCase->getExpect();

		$matchers = new Builder();
		$matchers->setExpect(200);

		if(!empty($this->testCase->getMatcher(self::TO_BE))) {
			$matchers->addMatcher(
				self::TO_BE,
				$this->testCase->getMatcher(self::TO_BE)
			);
		}

		if(!empty($this->testCase->getMatcher(self::TO_BE_A))) {
			$matchers->addMatcher(
				self::TO_BE_A,
				$this->testCase->getMatcher(self::TO_BE_A)
			);
		}

		return $matchers->match();
	}

}