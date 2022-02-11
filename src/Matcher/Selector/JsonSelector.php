<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

class JsonSelector extends AbstractSelector {

	public function __construct(array $selection) {
		$this->selection = $selection;
	}

	public function getSelection(HttpResponse $httpResponse): mixed {
		// TODO: Implement getSelection() method.
		return 200;
	}

}