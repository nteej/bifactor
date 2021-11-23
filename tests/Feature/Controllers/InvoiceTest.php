<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});
it('can create new invoice', function () {
    $attributes = Invoice::factory()->raw();
    $response = $this->postJson('api/v1/invoices', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
it('can create a invoice', function () {
    $attributes = Invoice::factory()->raw();
    $response = $this->postJson('api/v1/invoices', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
it('create new invoice with Uuid', function () {
    $invoice = Invoice::factory()->create();
    $this->assertNotEmpty($invoice->uuid);
});
it('can search invoice by Uuid', function () {
    $invoice = Invoice::factory()->create();
    $foundInvoice = Invoice::findByUuid($invoice->uuid);
    $this->assertNotNull($foundInvoice);
});
it('can fetch a invoice', function () {
    $invoice = Invoice::factory()->create();
    $response = $this->getJson("api/v1/invoices/{$invoice->uuid}");
    $data = [
        'uuid' => $invoice->uuid,
        'invoice_no' => $invoice->invoice_no,
        'due_date' => $invoice->due_date,
        'customer_id' => $invoice->customer_id,
        'company_id' => $invoice->company_id,
        'total_amount' => $invoice->total_amount,
        'info' => $invoice->info,
        'status' => $invoice->status
    ];
    $response->assertStatus(200)->assertJson($data);
});

it('can update a invoice', function () {
    $invoice = Invoice::factory()->create();
    $data = [
        'id'=>1,
        'invoice_no' => '1002',
        'due_date' => '2021-09-01',
        'customer_id' => 1,
        'company_id' => 1,
        'total_amount' => 1000,
        'status' => 1
    ];
    //dd($invoice->id);
    $response = $this->putJson("api/v1/invoices/{$invoice->id}", $data);
    $response->assertStatus(200)->assertJson($response->json());
    $this->assertDatabaseHas('invoices', $data);
});

it('can delete a invoice', function () {
    $invoice = Invoice::factory()->create();
    $response = $this->deleteJson("api/v1/invoices/{$invoice->uuid}");

    $response->assertStatus(200)->assertJson($response->json());
})->group('delete');


it('can make payment for an invoice', function () {
    $invoice = Invoice::factory()->create();
    $data = [
        'amount' => 1000,
        'invoice_id' => $invoice->id,
        'type' => 1,
        'info' => $invoice->toArray()
    ];
    $response = $this->postJson("api/v1/invoice/payment", $data);
    $response->assertStatus(200)->assertJson($response->json());
});



