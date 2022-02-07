<?php

namespace Arendsen\ApiTester;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HttpResponse {

	/**
	 * @var ResponseInterface $response
	 */
	protected ResponseInterface $response;

	public function __construct(ResponseInterface $response) {
		$this->response = $response;
	}

	public function getStatusCode(): int {
		return $this->response->getStatusCode();
	}

	public function getBody(): StreamInterface {
		return $this->response->getBody();
	}

}