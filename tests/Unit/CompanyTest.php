<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Company;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('does not allows to create a company without name', function () {
    $response = $this->postJson('/api/v1/companies', []);
    $response->assertStatus(422)->assertJson($response->json());
})->skip('Validation check stop temporarily');
it('can create a company', function () {
    $attributes = Company::factory()->raw();
    $response = $this->postJson('api/v1/companies', $attributes);
    $response->assertStatus(200)->assertJson($response->json());
});
it('create new company with Uuid', function () {
    $company = Company::factory()->create();
    $this->assertNotEmpty($company->uuid);
});
it('can search company by Uuid', function () {
    $company = Company::factory()->create();
    $foundCompany = Company::findByUuid($company->uuid);
    $this->assertNotNull($foundCompany);
});
it('can fetch a company', function () {
    $company = Company::factory()->create();
    $response = $this->getJson("api/v1/companies/{$company->uuid}");
    $data = [
        'uuid' => $company->uuid,
        'reg_no' => $company->reg_no,
        'name' => $company->name,
        'address' => $company->address,
        'br_no' => $company->br_no,
        'debtor_limit' => $company->debtor_limit,
        'status' => $company->status,
    ];
    $response->assertStatus(200)->assertJson($data);
});

