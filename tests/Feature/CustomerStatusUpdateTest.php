<?php

it('has customerstatusupdate page', function () {
    $response = $this->get('/customerstatusupdate');

    $response->assertStatus(200);
});
