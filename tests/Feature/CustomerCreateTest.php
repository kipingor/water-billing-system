<?php

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('has customercreate page', function () {
    $response = $this->get('/customers/create');

    $response->assertStatus(200);
});

it('validates registration form with precognition', function () {
    $response = $this->withPrecognition()
        ->post('/customers', [
            'name' => 'Taylor Otwell',
        ]);
 
    $response->assertSuccessfulPrecognition();
 
    expect(Customer::count())->toBe(0);
});