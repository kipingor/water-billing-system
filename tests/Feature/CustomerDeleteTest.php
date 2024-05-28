<?php

it('has customerdelete page', function () {
    $response = $this->get('/customerdelete');

    $response->assertStatus(200);
});
