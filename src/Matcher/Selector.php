<?php

namespace Arendsen\ApiTester\Matcher;

use Arendsen\ApiTester\Matcher\Selector\JsonSelector;

class Selector {

	const JSON = 'jsonSelector';

	public function create(array $expectedValue) {
		switch($expectedValue['type']) {
			case self::JSON:
				return new JsonSelector($expectedValue['selection']);
		}
	}

}