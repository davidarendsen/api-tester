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

	public function __construct(SourceInterface $schemaSource, array $options = []) {
		$this->schema = new Schema($schemaSource);
		$this->options = $options;
	}

	public function run() {
		$allowedRequestsToRun = $this->getConfig('allowedRequestsToRun');
		$disallowedRequestsToRun = $this->getConfig('disallowedRequestsToRun');

		foreach($this->schema->getRequests() as $key => $cases) {
			if(!empty($allowedRequestsToRun) && !in_array($key, $allowedRequestsToRun)) {
				continue;
			}
			if(!empty($disallowedRequestsToRun) && in_array($key, $disallowedRequestsToRun)) {
				continue;
			}

			describe($key, function() use ($cases) {
				foreach($cases as $case => $tests) {
					describe($case, function() use ($tests) {
						foreach($tests as $test) {
							it($test, function() {
								expect(true)->toBe(true);
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