<?php

use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;

describe('SchemaSource', function() {

	describe('Yaml source', function() {
		it('parses to an array', function() {
			$source = SchemaSource::create(Type::YAML);
			$source->parseFile(__DIR__ . '/yaml_source.yaml');

			itParsesTheCorrectResponse($source);
		});

		it('throws an exception  when file does not exist', function() {
			itThrowsExceptionWhenFileDoesNotExist(__DIR__ . '/yaml_does_not_exist.yaml');
		});
	});

	describe('Json source', function() {
		it('parses to an array', function() {
			$source = SchemaSource::create(Type::YAML);
			$source->parseFile(__DIR__ . '/json_source.json');

			itParsesTheCorrectResponse($source);
		});

		it('throws an exception  when file does not exist', function() {
			itThrowsExceptionWhenFileDoesNotExist(__DIR__ . '/json_does_not_exist.json');
		});
	});

});

function itParsesTheCorrectResponse($source) {
	expect($source->toArray())->toBeA('array');
	expect($source->toArray())->toBe([
		'base_uri' => 'https://reqres.in/api/',
		'environment_variables' => [
			'apiKey' => 'dErPcAsEaPiKeY',
		]
	]);
}


function itThrowsExceptionWhenFileDoesNotExist(string $filename) {
	$closure = function() use($filename) {
		$source = SchemaSource::create(Type::JSON);
		$source->parseFile($filename);
	};

	expect($closure)->toThrow(new Exception('Source file ' . $filename . ' does not exist!'));
}