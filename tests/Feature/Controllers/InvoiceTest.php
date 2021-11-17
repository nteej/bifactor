<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;


it('can create new invoice', function () {
    $attributes = Invoice::factory()->raw();
    $response = $this->postJson('api/v1/invoices', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
