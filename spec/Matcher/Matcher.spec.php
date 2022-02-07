<?php

use Arendsen\ApiTester\HttpClient;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher;

describe('Matcher', function() {

	context('match()', function() {
		$testCase = new TestCase([
			'description' => 'includes firstName as string',
			'expect' => [
				'type' => 'jsonSelector',
				'selection' => [
					'users', '0', 'firstName',
				]
			],
			'toBe' => [
				'type' => 'string',
				'value' => 'David',
			],

			//'toBeA' => 'string',
		]);

		$httpClient = new HttpClient('https://reqres.in/api/');
		$httpResponse = $httpClient->request(
			'GET',
			'users',
			[]
		);

		$matcher = new Matcher($testCase, $httpResponse);

		it('is an instanceof Kahlan\Expectation', function() use($matcher) {
			expect($matcher->match())->toBeAnInstanceOf('Kahlan\Expectation');
		});
	});

});