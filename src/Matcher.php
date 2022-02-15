<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\Matcher\Selector;
use Exception;
use Kahlan\Expectation;
use Arendsen\ApiTester\Schema\TestCase;
use Arendsen\ApiTester\Matcher\Builder;

class Matcher {

    const TO_BE = 'toBe';
    const TO_BE_A = 'toBeA';

    const MATCHERS = [
        self::TO_BE,
        self::TO_BE_A
    ];

    /**
     * @var TestCase $testCase
     */
    protected TestCase $testCase;

    /**
     * @var HttpResponse $httpResponse
     */
    protected HttpResponse $httpResponse;

    public function __construct(TestCase $testCase, HttpResponse $httpResponse) {
        $this->testCase = $testCase;
        $this->httpResponse = $httpResponse;
    }

    /**
     * @throws Exception
     */
    public function match(): Expectation {
        $expectedValue = $this->testCase->getExpectedValue();

        $selector = (new Selector())->create($expectedValue);
        $selection = $selector->getSelection($this->httpResponse);

        $matcherBuilder = new Builder();
        $matcherBuilder->setActualValue($selection);

        foreach($this->testCase->getMatchers() as $matcher => $matcherData) {
            $matcherBuilder->addMatcher($matcher, $matcherData);
        }

        return $matcherBuilder->match();
    }

}