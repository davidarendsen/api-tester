<?php

namespace Arendsen\ApiTester;

use Kahlan\Expectation;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher\Builder;
use Arendsen\ApiTester\Matcher\ExpectedValue;

class Matcher {

	const TO_BE = 'toBe';
	const TO_BE_A = 'toBeA';

	const MATCHERS = [
		self::TO_BE,
		self::TO_BE_A
	];

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
		$expectedValue = new ExpectedValue($this->testCase);

		$matcherBuilder = new Builder();
		$matcherBuilder->setExpectedValue($expectedValue->getValue());

		foreach($this->testCase->getMatchers() as $matcher => $matcherData) {
			$matcherBuilder->addMatcher($matcher, $matcherData);
		}

		return $matcherBuilder->match();
	}

}