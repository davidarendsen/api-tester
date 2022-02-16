<?php

use Arendsen\ApiTester\ApiTester;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;
use Arendsen\ApiTester\Schema;

describe('Schema', function() {
    $source = SchemaSource::create(Type::YAML);
    $source->parseEnvironmentVariablesFile(__DIR__ . '/schema/.env.yaml');
    $source->parsePreRequestsFile(__DIR__ . '/schema/.pre_requests.yaml');
    $source->parseDirectory(__DIR__ . '/schema/');

    $schema = new Schema($source);

    context('PreRequests', function() use($schema) {
        $preRequests = $schema->getPreRequests();

        it('contains key getUsersSuccessful', function() use($preRequests) {
            expect($preRequests)->toContainKey('getUsersSuccessful');
        });

        $preRequest = $preRequests['getUsersSuccessful'];

        it('is an instance of Arendsen\ApiTester\Schema\PreRequest', function() use($preRequest) {
            expect($preRequest)->toBeAnInstanceOf('Arendsen\ApiTester\Schema\PreRequest');
        });

        it('has a request_id of getUsersSuccessful', function() use($preRequest) {
            expect($preRequest->getRequestId())->toBe('getUsersSuccessful');
        });
    });
});