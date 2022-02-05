<?php

use Arendsen\ApiTester\ApiTest;
use Arendsen\ApiTester\Source;
use Arendsen\ApiTester\Specifications\Source\SourceType;

$requests = [
	'GET /accesstokens' => [
		'successful response' => [
			'has status code 200',
			'has property "accessToken"'
		],
		'unauthorized response' => [
			'has status code 401'
		],
	],
	'GET /users/{{userID}}' => [
		'successful response' => [
			'has status code 200'
		],
		'unauthorized response' => [
			'has status code 401'
		],
	],
];

$options = [
	'allowedRequestsToRun' => [
		'GET /accesstokens'
	],
//	'disallowedRequestsToRun' => [
//		'GET /users/{{userID}}',
//	],
];

try {
	$source = (new Source())->create(SourceType::YAML);
	$source->parseFile(__DIR__ . '/../config/tests.yaml');

	die(var_dump($source->toArray()));

	//$specification = new Specification($source);

	$apiTest = new ApiTest($requests, $options);
	$apiTest->run();
}
catch(Exception $e) {
	echo $e->getMessage();
}