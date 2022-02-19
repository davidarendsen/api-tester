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

        it('is an instance of Arendsen\ApiTester\Schema\Request', function() use($preRequests) {
            expect($preRequests[0])->toBeAnInstanceOf('Arendsen\ApiTester\Schema\Request');
        });

        context('Response', function() use($preRequests) {
            $expectedResponses = $preRequests[0]->getExpectedResponses();

            it('is an instance of Arendsen\ApiTester\Schema\Response', function() use($expectedResponses) {
                expect($expectedResponses[0])->toBeAnInstanceOf('Arendsen\ApiTester\Schema\Response');
            });

            $tasks = $expectedResponses[0]->getTasks();

            it('has tasks and those are an instance of Arendsen\ApiTester\Schema\Task', function() use($tasks) {
                expect($tasks[0])->toBeAnInstanceOf('Arendsen\ApiTester\Schema\Task');
            });

            it('has a task with a description', function() use($tasks) {
                expect($tasks[0]->getDescription())->toBe('Get userID');
            });
        });

    });
});