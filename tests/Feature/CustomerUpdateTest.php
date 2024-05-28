<?php

it('has customerupdate page', function () {
    $response = $this->get('/customerupdate');

    $response->assertStatus(200);
});
