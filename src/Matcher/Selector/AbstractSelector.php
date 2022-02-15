<?php

namespace Arendsen\ApiTester\Matcher\Selector;

use Arendsen\ApiTester\HttpResponse;

abstract class AbstractSelector implements SelectorInterface {

    /**
     * @var array $selection
     */
    protected $selection;

    public function __construct(array $selection) {
        $this->selection = $selection;
    }

    abstract public function getSelection(HttpResponse $httpResponse): mixed;

}