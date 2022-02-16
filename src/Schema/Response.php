<?php

namespace Arendsen\ApiTester\Schema;

class Response {

    /**
     * @var array $response
     */
    protected array $response;

    public function __construct(array $response) {
        $this->response = $response;
    }

    public function getDescription(): string {
        return $this->response['description'] ?? '';
    }

    public function getRequestId(): string {
        return $this->response['request_id'] ?? '';
    }

    public function getStatusCode(): int {
        return $this->response['status'] ?? 0;
    }

    public function getParameters(): array {
        return $this->response['parameters'] ?? [];
    }

    public function getTestCases(): array {
        $testCases = [];

        foreach($this->response['tests'] as $testCase) {
            $testCases[] = new TestCase($testCase);
        }

        return $testCases;
    }

    public function getTasks(): array {
        $tasks = [];

        foreach($this->response['tasks'] as $task) {
            $tasks[] = new Task($task);
        }

        return $tasks;
    }

}