<?php

namespace Arendsen\ApiTester\Schema;

class PreRequest {

    /**
     * @var array $preRequestData
     */
    protected array $preRequestData = [];

    public function __construct(array $preRequest) {
        $this->preRequestData = $preRequest;
    }

    public function getDescription(): string {
        return $this->preRequestData['description'] ?? '';
    }

    public function getRequestId(): string {
        return $this->preRequestData['request_id'] ?? '';
    }

    public function getResponseSelector(): string {
        return $this->preRequestData['response_selector'] ?? 'json';
    }

    public function getSelection(): array {
        return $this->preRequestData['selection'] ?? [];
    }

    public function getToEnv(): string {
        $toEnv = $this->preRequestData['to_env'] ?? '';
        return is_string($toEnv) ? $toEnv : '';
    }

}