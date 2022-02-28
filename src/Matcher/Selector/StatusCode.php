<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

class StatusCode extends AbstractSelector {

    public function getSelection(HttpResponse $httpResponse): mixed {
        return $httpResponse->getStatusCode();
    }

}