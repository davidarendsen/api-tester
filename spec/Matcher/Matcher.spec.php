<?php

use Arendsen\ApiTester\HttpClient;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher;

fdescribe('Matcher', function() {

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

});