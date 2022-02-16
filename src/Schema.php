<?php

namespace Arendsen\ApiTester;

use Exception;
use Arendsen\ApiTester\SchemaSource\SourceInterface;
use Arendsen\ApiTester\Schema\Request;
use Arendsen\ApiTester\Schema\PreRequest;

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
        return $this->setupRequests('paths');
    }

    public function getPreRequests(): array {
        return $this->setupRequests('pre_request_paths');
    }

    public function getEnvironmentVariables(): array {
        return $this->schema['environment_variables'] ?? [];
    }

    private function setupRequests(string $key): array {
        if(!isset($this->schema[$key])) {
            throw new Exception('You forgot to add ' . $key . ' in your schema!');
        }

        if(!is_array($this->schema[$key])) {
            throw new Exception($key . ' needs to be an array!');
        }

        $requests = [];

        foreach($this->schema[$key] as $path => $requestsArray) {
            foreach($requestsArray as $method => $responses) {
                $requests[] = new Request($method, $path, $responses);
            }
        }

        return $requests;
    }

}