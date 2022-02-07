<?php

use Arendsen\ApiTester\ApiTester;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type as SourceType;

try {
	$source = SchemaSource::create(SourceType::YAML);
	$source->parseFile(__DIR__ . '/yaml_test.yaml');

	$apiTester = new ApiTester($source, [
//		'allowedRequestsToRun' => [
//			'GET /accesstokens'
//		],
//		'disallowedRequestsToRun' => [
//			'GET /users/{{userID}}',
//		],
	]);
	$apiTester->run();
}
catch(Exception $e) {
	echo $e->getMessage();
}