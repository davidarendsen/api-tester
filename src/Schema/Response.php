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

	public function getDescription() {
		return $this->response['description'] ?? '';
	}

	public function getParameters() {
		return $this->response['parameters'] ?? [];
	}

	public function getTestCases(): array {
		$requests = [];

		foreach($this->requests as $method => $request) {
			$requests[] = new Request($method, $this->path, $request);
		}

		return $requests;
	}

}