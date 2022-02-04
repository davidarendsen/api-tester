<?php

namespace ApiTester\OpenApi;

use OpenAPI\Parser;

class OpenAPIWrapper {
	/**
	 * @var Parser $openApi
	 */
	protected $openApi;

	public function __construct() {
		$this->openApi = Parser::parse(__DIR__ . '/../config/openapi.yaml');
	}

	public function getPaths() {
		return $this->openApi->paths->getPatternedFields();
	}
}


// $openApi = new OpenApiWrapper();
//
// foreach($openApi->getPaths() as $path => $pathData) {
// 	var_dump(get_class($pathData));
//
// 	var_dump('Path: ' . $path);
// 	var_dump('Summary: ' . $pathData->get->summary);
//
// 	foreach($pathData->get->parameters as $parameter) {
// 		var_dump('Param: ' . $parameter->name . ' (' . $parameter->in . ')');
// 	}
//
// 	foreach($pathData->get->responses->getPatternedFields() as $statusCode => $responseData) {
// 		var_dump($statusCode . ': ' . $responseData->description);
// 		var_dump($responseData->content['application/json']->schema->properties->getPatternedFields());
// 		die();
// 	}
//
// 	echo PHP_EOL;
// }
