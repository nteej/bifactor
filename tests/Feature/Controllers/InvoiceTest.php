<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;

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
        'reg_no' => $invoice->reg_no,
        'name' => $invoice->name,
        'address' => $invoice->address,
        'br_no' => $invoice->br_no,
        'debtor_limit' => $invoice->debtor_limit,
        'status' => $invoice->status
    ];
    $response->assertStatus(200)->assertJson($data);
});

it('can update a invoice', function () {
    $invoice = Invoice::factory()->create();
    $data = [
        'reg_no' => '1234',
        'name' => 'Test Invoice',
        'address' => 'Test Address',
        'br_no' =>'3456y',
        'debtor_limit' => 1200,
        'status' =>0,
    ];
    $response = $this->putJson("api/v1/invoices/{$invoice->uuid}", $data);
    $response->assertStatus(200)->assertJson($response->json());
    $this->assertDatabaseHas('invoices', $data);
});

it('can delete a invoice', function () {
    $invoice = Invoice::factory()->create();
    $response = $this->deleteJson("api/v1/invoices/{$invoice->uuid}");

    $response->assertStatus(200)->assertJson($response->json());
})->group('delete');
