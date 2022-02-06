<?php

namespace Arendsen\ApiTester\Schema;

class Request {

	/**
	 * @var string $method
	 */
	protected string $method;

	/**
	 * @var string $path
	 */
	protected string $path;

	/**
	 * @var array $responses
	 */
	protected array $responses;

	public function __construct(string $method, string $path, array $responses) {
		$this->method = $method;
		$this->path = $path;
		$this->responses = $responses;
	}

	public function getMethod() {
		return strtoupper($this->method);
	}

	public function getPath() {
		return trim($this->path);
	}

	public function getMethodAndPath() {
		return $this->getMethod() . ' ' . $this->getPath();
	}

	public function getResponses() {
		$responses = [];

		foreach($this->responses as $response) {
			$responses[] = new Response($response);
		}

		return $responses;
	}

}