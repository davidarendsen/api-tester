<?php

namespace Arendsen\ApiTester;

use GuzzleHttp\Client;

class HttpClient {

	/**
	 * @var Client $httpClient
	 */
	protected Client $httpClient;

	public function __construct(string $baseUri) {
		$this->httpClient = new Client(['base_uri' => $baseUri]);
	}

	public function request(string $method, string $path, array $parameters): HttpResponse {
		return new HttpResponse(
			$this->httpClient->request(
				$method,
				$path,
				array_merge($parameters, ['http_errors' => false])
			)
		);
	}

}