<?php

namespace Arendsen\ApiTester;

class ApiTest {

	/**
	 * @var array $requests
	 */
	protected array $requests;

	/**
	 * @var array $options
	 */
	protected array $options = [];

	public function __construct(array $requests, array $options = []) {
		$this->requests = $requests;
		$this->options = $options;
	}

	public function run() {
		$allowedRequestsToRun = $this->getConfig('allowedRequestsToRun');
		$disallowedRequestsToRun = $this->getConfig('disallowedRequestsToRun');

		foreach($this->requests as $key => $cases) {
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