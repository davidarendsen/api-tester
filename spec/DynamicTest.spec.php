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

$options = [
//	'allowedRequestsToRun' => [
//		'GET /users/{{userID}}'
//	],
//	'disallowedRequestsToRun' => [
//		'GET /users/{{userID}}',
//	],
];

try {
	$apiTest = new ApiTest($requests, $options);
	$apiTest->run();
}
catch(Exception $e) {
	echo $e->getMessage();
}