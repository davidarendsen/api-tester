<?php
namespace ApiTester;

class ApiTest
{
	/**
	 * @var $requests
	 */
	protected $requests;

	public function __construct(array $requests) {
		$this->requests = $requests;
	}

	public function run() {

		foreach($this->requests as $key => $cases) {
		  describe($key, function() use($cases) {
			  foreach($cases as $case => $tests) {
				  describe($case, function() use($tests) {
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
}