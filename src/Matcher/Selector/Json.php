<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

class Json extends AbstractSelector {

	public function getSelection(HttpResponse $httpResponse): mixed {
		$response = $this->getJsonDecodedResponse($httpResponse);

		foreach($this->selection as $select) {
            $response = $response[$select];
        }

		return $response;
	}

	private function getJsonDecodedResponse(HttpResponse $httpResponse): array {
		return json_decode($httpResponse->getBody(), true);
	}

}