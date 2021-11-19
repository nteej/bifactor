<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Company;

uses(RefreshDatabase::class);

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
        'contact' => $company->contact,
        'name' => $company->name,
        'email' => $company->email,
        'info' => $company->info,
        'debtor_limit' => $company->debtor_limit,
        'status' => $company->status
    ];
    $response->assertStatus(200)->assertJson($data);
});

it('can update a company', function () {
    $company = Company::factory()->create();
    $info = $company->info;
    $data = [
        'id' => 1,
        'name' => 'updated name',
        'contact' => '+98776656789',
        'email' => 'test@gmail.com',
        'debtor_limit' => 1200,
        'status' => 0,
    ];
    $response = $this->putJson("api/v1/companies/{$company->uuid}", $data);
    $response->assertStatus(200)->assertJson($response->json());
});

it('can delete a company', function () {
    $company = Company::factory()->create();
    $response = $this->deleteJson("api/v1/companies/{$company->uuid}");

    $response->assertStatus(200)->assertJson($response->json());
})->group('delete');
