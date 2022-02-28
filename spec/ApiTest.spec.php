<?php

use Arendsen\ApiTester\ApiTester;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;

try {
    $source = SchemaSource::create(Type::YAML);
    $source->parseEnvironmentVariablesFile(__DIR__ . '/schema/.env.yaml');
    $source->parseDirectory(__DIR__ . '/schema/');

    $apiTester = new ApiTester($source, [
//      'allowedRequestsToRun' => [
//          'GET /accesstokens'
//      ],
//      'disallowedRequestsToRun' => [
//          'GET /users/{{userID}}',
//      ],
    ]);
    $apiTester->run();
}
catch(Exception $e) {
    echo $e->getMessage();
}