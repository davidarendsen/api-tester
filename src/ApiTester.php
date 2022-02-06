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
	protected $httpClient;

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

			describe($request->getMethodAndPath(), function() use($request) {
				foreach($request->getResponses() as $response) {

// 					$response = $this->httpClient->request(
//         				$request->getMethod(),
//         				$request->getPath(),
//         				array_merge($response->getParameters(), ['http_errors' => false])
//         			);

					describe($response->getDescription(), function() use ($response) {
// 						foreach($tests as $test) {
// 							it($test, function() {
// 								expect(true)->toBe(true);
// 							});
// 						}
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