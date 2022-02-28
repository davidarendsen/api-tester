# API Tester

With this package you can test API's based on a YAML or JSON file.
It's using the Kahlan Unit & BDD test framework.

## Example usage
* First install the package with ````composer require arendsen/api-tester````

* Create a ````spec/ApiTest.spec.php```` file with this content:

````php
<?php

use Arendsen\ApiTester\ApiTester;
use Arendsen\ApiTester\SchemaSource;
use Arendsen\ApiTester\SchemaSource\Type;

try {
    $source = SchemaSource::create(Type::YAML);
    $source->parseEnvironmentVariablesFile(__DIR__ . '/tests/.env.yaml');
    $source->parseDirectory(__DIR__ . '/tests');

    $apiTester = new ApiTester($source);
    $apiTester->run();
}
catch(Exception $e) {
    echo $e->getMessage();
}
````

* Create a ````spec/tests/.env.yaml```` file with this content:
````yaml
base_uri: https://reqres.in/api/
environment_variables:
  apiKey: dErPcAsEaPiKeY
````

* Separate all your endpoints in different files. Just make sure the paths are unique.
Create a ````spec/tests/posts.yaml```` file with this content:
````yaml
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
            to_be:
              type: integer
              value: 200
          - description: contains a name with value 'cerulean'
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            to_be:
              type: string
              value: cerulean
          - description: contains a name with type string
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            to_be_a: string
      - description: Unauthorized response (401)
        status: 401
        parameters:
          json:
            username: david
            password: test1234
          headers:
            Api-Key: "{{apiKey}}"
        tests:
          - description: contains a name with value 'cerulean'
            expect:
              selector: json
              selection:
                - data
                - 0
                - name
            to_be:
              type: string
              value: cerulean
            to_be_a: string

    post:
      - description: Successful operation (200)
        status: 200
        parameters:
          json:
            username: david
            password: test1234
            apiKey: "{{apiKey}}"
          headers:
            Api-Key: "{{apiKey}}"
        tests:
          - description: contains an apiKey with value of {{apiKey}}
            expect:
              selector: json
              selection:
                - apiKey
            to_be:
              type: string
              value: "{{apiKey}}"
````

* Run this command ````vendor/bin/kahlan --reporter=verbose````


### TODO
* Generate a YAML test schema from an OpenAPI schema.
* Add more Matchers and Selectors