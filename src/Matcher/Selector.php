<?php

namespace Arendsen\ApiTester\Matcher;

use Exception;
use Arendsen\ApiTester\Matcher\Selector\SelectorInterface;
use Arendsen\ApiTester\Matcher\Selector\Json;
use Arendsen\ApiTester\Matcher\Selector\StatusCode;

class Selector {

	const JSON = 'json';
	const STATUS_CODE = 'statusCode';

	public function create(array $expectedValue): SelectorInterface {
		switch($expectedValue['selector']) {
			case self::JSON:
				return new Json($expectedValue['selection']);
			case self::STATUS_CODE:
				return new StatusCode($expectedValue['selection']);
			default:
				throw new Exception('Selector ' . $expectedValue['selector'] . ' does not exist');
		}
	}

}