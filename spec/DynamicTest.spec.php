<?php

use ApiTester\ApiTest;

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

$apiTest = new ApiTest($requests);

$apiTest->run();