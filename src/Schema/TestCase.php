<?php

namespace Arendsen\ApiTester\Schema;

use Arendsen\ApiTester\Matcher;

class TestCase {

    /**
     * @var array $testCase
     */
    protected array $testCase;

    public function __construct(array $testCase) {
        $this->testCase = $testCase;
    }

    public function getDescription(): string {
        return $this->testCase['description'] ?? '';
    }

    public function getExpectedValue(): array {
        return $this->testCase['expect'] ?? [];
    }

    public function getMatchers(): array {
        $matchers = [];

        foreach(Matcher::MATCHERS as $matcherType) {
            if(!empty($this->getMatcher($matcherType))) {
                $matchers[$matcherType] = $this->getMatcher($matcherType);
            }
        }

        return $matchers;
    }

    protected function getMatcher(string $matcher): mixed {
        return $this->testCase[$matcher] ?? [];
    }

}