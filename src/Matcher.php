<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\Schema\TestCase;
use Kahlan\Expectation;

class Matcher {

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
		return expect($this->httpResponse->getStatusCode())->toBe(200);
	}

}