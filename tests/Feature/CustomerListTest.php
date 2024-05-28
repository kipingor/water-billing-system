<?php

it('has customerlist page', function () {
    $response = $this->get('/customerlist');

    $response->assertStatus(200);
});
