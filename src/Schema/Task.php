<?php

namespace Arendsen\ApiTester\Schema;

class Task {

    /**
     * @var array $taskData
     */
    protected array $taskData = [];

    public function __construct(array $task) {
        $this->taskData = $task;
    }

    public function getDescription(): string {
        return $this->taskData['description'] ?? '';
    }

    public function getRequestId(): string {
        return $this->taskData['request_id'] ?? '';
    }

    public function getResponseSelector(): string {
        return $this->taskData['response_selector'] ?? 'json';
    }

    public function getSelection(): array {
        return $this->taskData['selection'] ?? [];
    }

    public function getToEnv(): string {
        $toEnv = $this->taskData['to_env'] ?? '';
        return is_string($toEnv) ? $toEnv : '';
    }

}