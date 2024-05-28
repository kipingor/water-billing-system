<?php

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('customer has valid factory', function () {
    $customer = Customer::factory()->create();

    $this->assertModelExists($customer);
});

test('customer has required fields', function () {
    $customer = Customer::factory()->make([
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'phone_number' => '',
        'idnumber' => '',
        'physical_address' => '',
        'postal_address' => '',
        'account_number' => '',
    ]);

    $this->assertFalse($customer->saveQuietly());
    $this->assertNotEmpty($customer->errors()->get('first_name'));
    $this->assertNotEmpty($customer->errors()->get('last_name'));
    $this->assertNotEmpty($customer->errors()->get('email'));
    $this->assertNotEmpty($customer->errors()->get('phone_number'));
    $this->assertNotEmpty($customer->errors()->get('idnumber'));
    $this->assertNotEmpty($customer->errors()->get('physical_address'));
    $this->assertNotEmpty($customer->errors()->get('postal_address'));
    $this->assertNotEmpty($customer->errors()->get('account_number'));
});
