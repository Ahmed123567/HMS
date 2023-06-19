<?php

test('example', function () {
    $response = $this->get('/');

    expect($response->status())->toBe(200);
});
