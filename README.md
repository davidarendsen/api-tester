# API Tester

With this package you can test API's based on a YAML or JSON file.
It's using the Kahlan Unit & BDD test framework.

## How to use
* ````composer require arendsen/api-tester````
* Create a spec/ApiTest.spec.php file with this content:

````
<?php

use Arendsen\ApiTester\ApiTester;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;

try {
    $source = SchemaSource::create(Type::YAML);
    $source->parseFile(__DIR__ . '/yaml_test.yaml');

    $apiTester = new ApiTester($source);
    $apiTester->run();
}
catch(Exception $e) {
    echo $e->getMessage();
}
````

* Create a spec/yaml_test.yaml file with this content:
````
base_uri: https://reqres.in/api/
environment_variables:
  apiKey: dErPcAsEaPiKeY
paths:
  posts:
    get:
      - description: Successful operation (200)
        status: 200
        parameters:
          json:
            username: david
            password: test1234
          headers:
            Api-Key: "{{apiKey}}"
        tests:
          - description: contains a status code of 200
            expect:
              selector: statusCode
              selection:
                - 200
            toBe:
              type: integer
              value: 200
          - description: contains a name with value 'cerulean'
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            toBe:
              type: string
              value: cerulean
          - description: contains a name with type string
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            toBeA: string
      - description: Unauthorized response (401)
        status: 200
        parameters:
          json:
            username: david
            password: test1234
          headers:
            Api-Key: "{{apiKey}}"
        tests:
          - description: contains a nName with value 'cerulean'
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            toBe:
              type: string
              value: cerulean
            toBeA: string

  users:
    get:
      - description: Successful operation (200)
        status: 200
        parameters:
          json:
            username: david
            password: test1234
          headers:
            Api-Key: "{{apiKey}}"
        tests:
          - description: contains an id with value of 1
            expect:
              selector: json
              selection:
                - data
                - 0
                - id
            toBe:
              type: integer
              value: 1
            toBeA: integer
````

### TODO
* Generate a YAML test schema from an OpenAPI schema.
* Add more Matchers and Selectors