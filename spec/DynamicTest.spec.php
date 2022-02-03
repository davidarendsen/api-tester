<?php

$requests = [
    'GET /accesstokens' => [
        'successful response' => [
            'has status code 200',
            'has property "accessToken"'
        ],
        'unauthorized response' => [
            'has status code 401'
        ],
    ],
    'GET /users/{{userID}}' => [
        'successful response' => [
            'has status code 200'
        ],
        'unauthorized response' => [
            'has status code 401'
        ],
    ],
];

foreach($requests as $key => $cases) {

  describe($key, function() use($cases) {
      foreach($cases as $case => $tests) {
          describe($case, function() use($tests) {
              foreach($tests as $test) {
                  it($test, function() {
                      expect(true)->toBe(true);
                  });
              }
          });
      }
  });

}
