<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

interface SelectorInterface {

    public function getSelection(HttpResponse $httpResponse): mixed;

}