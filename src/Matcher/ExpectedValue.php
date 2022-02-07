<?php

namespace Arendsen\ApiTester\Matcher;

use Exception;
use Kahlan\Expectation;
use Arendsen\ApiTester\Matcher;
use Arendsen\ApiTester\Schema\TestCase;

class ExpectedValue {

	/**
	 * @var array $expectedValue
	 */
	protected array $expectedValue;

	public function __construct(TestCase $testCase) {
		$this->expectedValue = $testCase->getExpectedValue();
	}

	public function getValue(): mixed {
		return 200;
	}

}