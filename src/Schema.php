<?php

namespace Arendsen\ApiTester;

use Exception;
use Arendsen\ApiTester\SchemaSource\SourceInterface;
use Arendsen\ApiTester\Schema\Request;

class Schema {

    /**
     * @var array $schema
     */
    protected array $schema;

    public function __construct(SourceInterface $schemaSource) {
        $this->schema = $schemaSource->toArray();
    }

    public function getBaseUri(): string {
        return $this->schema['base_uri'] ?? '';
    }

    public function getRequests(): array {
        if(!isset($this->schema['paths'])) {
            throw new Exception('You forgot to add the paths in your schema!');
        }

        if(!is_array($this->schema['paths'])) {
            throw new Exception('Paths needs to be an array!');
        }

        $requests = [];

        foreach($this->schema['paths'] as $path => $requestsArray) {
            foreach($requestsArray as $method => $responses) {
                $requests[] = new Request($method, $path, $responses);
            }
        }

        return $requests;
    }

    public function getEnvironmentVariables(): array {
        return $this->schema['environment_variables'] ?? [];
    }

}