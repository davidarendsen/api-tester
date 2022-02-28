<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;

class Json extends AbstractSource {

    /**
     * @var string $extension
     */
    protected string $extension = 'json';

    protected function parse(string $content): void {
        $sourceArray = json_decode($content, true);
        $this->addToSourceArray($sourceArray);
    }

}