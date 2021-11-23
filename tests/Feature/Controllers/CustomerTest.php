<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use \Laravel\Sanctum\Sanctum;
use App\Models\User;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});
it('can create a customer', function () {
    $attributes = Customer::factory()->raw();
    $response = $this->postJson('api/v1/customers', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
it('create new customer with Uuid', function () {
    $customer = Customer::factory()->create();
    $this->assertNotEmpty($customer->uuid);
});
it('can search customer by Uuid', function () {
    $customer = Customer::factory()->create();
    $foundCompany = Customer::findByUuid($customer->uuid);
    $this->assertNotNull($foundCompany);
});
it('can fetch a customer', function () {
    $customer = Customer::factory()->create();
    $response = $this->getJson("api/v1/customers/{$customer->uuid}");
    $data = [
        'uuid' => $customer->uuid,
        'contact' => $customer->contact,
        'name' => $customer->name,
        'email' => $customer->email,
        'info' => $customer->info,
        'debtor_limit' => $customer->debtor_limit,
        'status' => $customer->status
    ];
    $response->assertStatus(200)->assertJson($data);
});

it('can update a customer', function () {
    $customer = Customer::factory()->create();
    $info = $customer->info;
    $data = [
        'id' => 1,
        'name' => 'updated name',
        'contact' => '+98776656789',
        'email' => 'test@gmail.com',
        'debtor_limit' => 1200,
        'status' => 0,
    ];
    $response = $this->putJson("api/v1/customers/{$customer->uuid}", $data);
    $response->assertStatus(200)->assertJson($response->json());
});

it('can delete a customer', function () {
    $customer = Customer::factory()->create();
    $response = $this->deleteJson("api/v1/customers/{$customer->uuid}");

    $response->assertStatus(200)->assertJson($response->json());
})->group('delete');
