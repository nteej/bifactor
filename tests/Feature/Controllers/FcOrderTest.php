<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use  \App\Models\FcOrder;

uses(RefreshDatabase::class);

it('can create a factoring order', function () {
    $attributes = FcOrder::factory()->raw();
    $response = $this->postJson('api/v1/fcOrders', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
it('create new factoring order with Uuid', function () {
    $company = FcOrder::factory()->create();
    $this->assertNotEmpty($company->uuid);
});
it('can search factoring order by Uuid', function () {
    $company = FcOrder::factory()->create();
    $foundCompany = FcOrder::findByUuid($company->uuid);
    $this->assertNotNull($foundCompany);
});
it('can fetch a factoring order', function () {
    $company = FcOrder::factory()->create();
    $response = $this->getJson("api/v1/fcOrders/{$company->uuid}");
    $data = [
        'uuid' => $company->uuid,
        'order_no' => $company->order_no,
        'order_date' => $company->order_date,
        'company_id' => $company->company_id,
        'invoice_id' => $company->invoice_id,
        'status' => $company->status,
    ];
    $response->assertStatus(200)->assertJson($data);
});

it('can update a factoring order', function () {
    $company = FcOrder::factory()->create();
    $data = [
        "order_no" => "1238",
        "invoice_id" => 1,
        "company_id" => 1,
        "order_date" => "2021-11-06",
        "status" => 1
    ];
    $response = $this->putJson("api/v1/fcOrders/{$company->uuid}", $data);
    $response->assertStatus(200)->assertJson($response->json());
    $this->assertDatabaseHas('fc_orders', $data);
});

it('can delete a factoring order', function () {
    $company = FcOrder::factory()->create();
    $response = $this->deleteJson("api/v1/fcOrders/{$company->uuid}");

    $response->assertStatus(200)->assertJson($response->json());
})->group('delete');
