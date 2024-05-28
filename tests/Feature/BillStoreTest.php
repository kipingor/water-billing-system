<?php

use App\Models\User;
use App\Models\Meter;
use App\Models\MeterReading;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('successfully creates a bill', function () {
    $user = User::factory()->create();
    $meter = Meter::factory()->create();
    $data = [
        'meter_id' => $meter->id,
        'reading_value' => 12345,
        'reading_date' => '2023-01-01',
    ];

    actingAs($user)
        ->postJson(route('bills.store'), $data)
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJsonStructure([
            'data' => [
                'id',
                'meter_id',
                'reading_value',
                'reading_date',
                'employee_id',
            ],
        ]);

    $this->assertDatabaseHas('meter_readings', [
        'meter_id' => $meter->id,
        'reading_value' => 12345,
        'reading_date' => '2023-01-01',
        'employee_id' => $user->id,
    ]);
});

it('returns error when meter reading fails to save', function () {
    $user = User::factory()->create();
    $meter = Meter::factory()->create();
    $data = [
        'meter_id' => $meter->id,
        'reading_value' => 12345,
        'reading_date' => '2023-01-01',
    ];

    // Mock the failure of saving a meter reading
    MeterReading::shouldReceive('save')
        ->once()
        ->andReturn(false);

    actingAs($user)
        ->postJson(route('bills.store'), $data)
        ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
        ->assertJson([
            'error' => 'Failed to save meter reading',
        ]);
});

it('returns error when bill generation fails', function () {
    $user = User::factory()->create();
    $data = [
        'meter_id' => 1,
        'reading_value' => 12345,
        'reading_date' => '2023-01-01',
    ];

    // Assuming BillingService is bound in the service container
    $mockBillingService = Mockery::mock(BillingService::class);
    $mockBillingService->shouldReceive('generateBill')
        ->once()
        ->andReturn(null);

    $this->app->instance(BillingService::class, $mockBillingService);

    actingAs($user)
        ->postJson(route('bills.store'), $data)
        ->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
        ->assertJson([
            'error' => 'Failed to generate bill',
        ]);
});