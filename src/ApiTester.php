<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\SchemaSource\SourceInterface;
use Arendsen\ApiTester\HttpClient;

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
	}

	public function run() {
		$allowedRequestsToRun = $this->getConfig('allowedRequestsToRun');
		$disallowedRequestsToRun = $this->getConfig('disallowedRequestsToRun');
		$httpClient = new HttpClient($this->schema->getBaseUri());
		$schema = $this->schema;

		describe('ApiTester', function() use($allowedRequestsToRun, $disallowedRequestsToRun, $httpClient, $schema) {

			foreach($schema->getRequests() as $request) {
				if(!empty($allowedRequestsToRun) && !in_array($request->getMethodAndPath(), $allowedRequestsToRun)) {
					continue;
				}
				if(!empty($disallowedRequestsToRun) && in_array($request->getMethodAndPath(), $disallowedRequestsToRun)) {
					continue;
				}

				describe($request->getMethodAndPath(), function() use($request, $httpClient) {
					foreach($request->getExpectedResponses() as $expectedResponse) {
						$httpResponse = $httpClient->request(
	                        $request->getMethod(),
	                        $request->getPath(),
	                        $expectedResponse->getParameters()
	                    );

						describe($expectedResponse->getDescription(), function() use ($expectedResponse, $httpResponse) {
							foreach($expectedResponse->getTestCases() as $testCase) {
								$matcher = new Matcher($testCase, $httpResponse);

								it($testCase->getDescription(), function() use($matcher) {
									$matcher->match();
								});
							}
						});
					}
				});
			}

		});

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