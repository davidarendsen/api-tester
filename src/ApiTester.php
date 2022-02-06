<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\SchemaSource\SourceInterface;
use GuzzleHttp\Client as HttpClient;

class ApiTester {

	/**
	 * @var Schema $schema
	 */
	protected Schema $schema;

	/**
	 * @var array $options
	 */
	protected array $options = [];

	/**
	 * @var HttpClient $httpClient
	 */
	protected HttpClient $httpClient;

	public function __construct(SourceInterface $schemaSource, array $options = []) {
		$this->schema = new Schema($schemaSource);
		$this->options = $options;

		$this->httpClient = new HttpClient(['base_uri' => $this->schema->getBaseUri()]);
	}

	public function run() {
		$allowedRequestsToRun = $this->getConfig('allowedRequestsToRun');
		$disallowedRequestsToRun = $this->getConfig('disallowedRequestsToRun');

		foreach($this->schema->getRequests() as $request) {
			if(!empty($allowedRequestsToRun) && !in_array($request->getMethodAndPath(), $allowedRequestsToRun)) {
				continue;
			}
			if(!empty($disallowedRequestsToRun) && in_array($request->getMethodAndPath(), $disallowedRequestsToRun)) {
				continue;
			}

			$httpClient = $this->httpClient;

			describe($request->getMethodAndPath(), function() use($request, $httpClient) {
				foreach($request->getResponses() as $expectedResponse) {

					$httpResponse = $httpClient->request(
        				$request->getMethod(),
        				$request->getPath(),
        				array_merge($expectedResponse->getParameters(), ['http_errors' => false])
        			);

					describe($expectedResponse->getDescription(), function() use ($expectedResponse, $httpResponse) {

						foreach($expectedResponse->getTestCases() as $testCase) {
							it($testCase->getDescription(), function() use($expectedResponse, $httpResponse) {
								expect($httpResponse->getStatusCode())->toBe($expectedResponse->getStatusCode());
							});
						}
					});
				}
			});
		}
	}

	/**
	 * @param string $key
	 *
	 * @return mixed
	 */
	protected function getConfig(string $key): mixed {
		if(isset($this->options[$key])) {
			return $this->options[$key];
		}

		return null;
	}
}