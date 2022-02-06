<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\Schema\TestCase;
use GuzzleHttp\Psr7\Response;

class Matcher {

	/**
	 * @var TestCase $testCase
	 */
	protected TestCase $testCase;

	/**
	 * @var Response $httpResponse
	 */
	protected Response $httpResponse;

	public function __construct(TestCase $testCase, Response $httpResponse) {
		$this->testCase = $testCase;
		$this->httpResponse = $httpResponse;
	}

	public function match() {
		expect(200)->toBe(200);
	}

}