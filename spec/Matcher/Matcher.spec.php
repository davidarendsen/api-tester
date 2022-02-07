<?php

use Arendsen\ApiTester\HttpClient;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher;
use Arendsen\ApiTester\Matcher\Builder;

describe('Matcher', function() {

	$source = SchemaSource::create(Type::YAML);
	$source->parseFile(__DIR__ . '/tests.yaml');

	context('match()', function() use($source) {
		$testCase = new TestCase($source->toArray()[0]);

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

	context('Matcher/Builder', function() use ($source) {
		$testCase = new TestCase($source->toArray()[0]);

		it('is an instanceof Kahlan\Expectation', function() use($testCase) {
			$matcherBuilder = new Builder();
			$matcherBuilder->setExpect(200);

			if(!empty($testCase->getMatcher(Matcher::TO_BE))) {
				$matcherBuilder->addMatcher(
					Matcher::TO_BE,
					$testCase->getMatcher(Matcher::TO_BE)
				);
			}

			if(!empty($testCase->getMatcher(Matcher::TO_BE_A))) {
				$matcherBuilder->addMatcher(
					Matcher::TO_BE_A,
					$testCase->getMatcher(Matcher::TO_BE_A)
				);
			}

			expect($matcherBuilder->match())->toBeAnInstanceOf('Kahlan\Expectation');
		});
	});

});