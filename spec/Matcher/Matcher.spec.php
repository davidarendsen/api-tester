<?php

use Arendsen\ApiTester\HttpClient;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher;
use Arendsen\ApiTester\Matcher\Builder;
use Arendsen\ApiTester\Matcher\Selector;

describe('Matcher', function() {

	$source = SchemaSource::create(Type::YAML);
	$source->parseFile(__DIR__ . '/tests.yaml');

	context('match()', function() use ($source) {
		$testCase = new TestCase($source->toArray()[0]);

		$httpClient = new HttpClient('https://reqres.in/api/');
		$httpResponse = $httpClient->request(
			'GET',
			'users',
			[]
		);

		$matcher = new Matcher($testCase, $httpResponse);

		it('is an instanceof Kahlan\Expectation', function() use ($matcher) {
			expect($matcher->match())->toBeAnInstanceOf('Kahlan\Expectation');
		});
	});

	context('Matcher/Builder', function() use ($source) {
		$testCase = new TestCase($source->toArray()[0]);

		it('is an instanceof Kahlan\Expectation', function() use ($testCase) {
			$matcherBuilder = new Builder();
			$matcherBuilder->setActualValue(200);

			foreach($testCase->getMatchers() as $matcher => $matcherData) {
				$matcherBuilder->addMatcher($matcher, $matcherData);
			}

			expect($matcherBuilder->match())->toBeAnInstanceOf('Kahlan\Expectation');
		});
	});

	context('Matcher/Builder with Selector', function() use ($source) {
		$testCase = new TestCase($source->toArray()[0]);

		it('is an instanceof Kahlan\Expectation', function() use ($testCase) {
			$httpClient = new HttpClient('https://reqres.in/api/');
			$httpResponse = $httpClient->request(
				'GET',
				'users',
				[]
			);

			$expectedValue = $testCase->getExpectedValue();

			$selector = (new Selector())->create($expectedValue);
			$selection = $selector->getSelection($httpResponse);

			$matcherBuilder = new Builder();
			$matcherBuilder->setActualValue($selection);

			foreach($testCase->getMatchers() as $matcher => $matcherData) {
				$matcherBuilder->addMatcher($matcher, $matcherData);
			}

			expect($matcherBuilder->match())->toBeAnInstanceOf('Kahlan\Expectation');
		});
	});
});