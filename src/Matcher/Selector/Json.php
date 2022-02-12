<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

class Json extends AbstractSelector {

	public function getSelection(HttpResponse $httpResponse): mixed {
		// TODO: Implement getSelection() method.
		return 200;
	}

}