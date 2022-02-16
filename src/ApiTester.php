<?php

namespace Arendsen\ApiTester;

use Arendsen\ApiTester\SchemaSource\SourceInterface;
use Arendsen\ApiTester\HttpClient;
use Arendsen\ApiTester\Schema\Request;

class ApiTester {

    /**
     * @var Schema $schema
     */
    protected Schema $schema;

    /**
     * @var array $options
     */
    protected array $options = [];

    /**
     * @var HttpClient $httpClient
     */
    protected HttpClient $httpClient;

    public function __construct(SourceInterface $schemaSource, array $options = []) {
        $this->schema = new Schema($schemaSource);
        $this->options = $options;
        $this->httpClient = new HttpClient($this->schema->getBaseUri());
    }

    public function run() {
        $apiTester = $this;

        describe('ApiTester', function() use($apiTester) {
            foreach($apiTester->schema->getPreRequests() as $request) {
                $apiTester->runRequest($request);
            }

            foreach($apiTester->schema->getRequests() as $request) {
                $apiTester->runRequest($request);
            }
        });

    }

    private function runRequest(Request $request) {
        $apiTester = $this;

        if($this->isDisallowed($request)) {
            return;
        }

        describe($request->getMethodAndPath(), function() use($request, $apiTester) {
            foreach($request->getExpectedResponses() as $expectedResponse) {
                $httpResponse = $apiTester->httpClient->request(
                    $request->getMethod(),
                    $request->getPath(),
                    $expectedResponse->getParameters()
                );

                //TODO: Execute tasks $expectedResponse->getTasks();

                context($expectedResponse->getDescription(), function() use ($expectedResponse, $httpResponse) {
                    foreach($expectedResponse->getTestCases() as $testCase) {
                        $matcher = new Matcher($testCase, $httpResponse);

                        it($testCase->getDescription(), function() use($matcher) {
                            $matcher->match();
                        });
                    }
                });
            }
        });
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    protected function getConfig(string $key): mixed {
        if(isset($this->options[$key])) {
            return $this->options[$key];
        }

        return null;
    }

    protected function isDisallowed(Request $request): bool {
        $allowedRequestsToRun = $this->getConfig('allowedRequestsToRun');
        $disallowedRequestsToRun = $this->getConfig('disallowedRequestsToRun');

        if(!empty($allowedRequestsToRun) && !in_array($request->getMethodAndPath(), $allowedRequestsToRun)) {
            return true;
        }
        if(!empty($disallowedRequestsToRun) && in_array($request->getMethodAndPath(), $disallowedRequestsToRun)) {
            return true;
        }

        return false;
    }
}