<?php

namespace Arendsen\ApiTester;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpClient {

	/**
	 * @var Client $httpClient
	 */
	protected Client $httpClient;

	public function __construct(string $baseUri) {
		$this->httpClient = new Client(['base_uri' => $baseUri]);
	}

	public function request(string $method, string $path, array $parameters): Response {
		return $this->httpClient->request($method, $path, array_merge($parameters, ['http_errors' => false]));
	}

}