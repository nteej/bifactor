<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /** @test */
    public function canCreateACompany()
    {
        $data = [
            'uuid' => $this->faker->uuid(),
            'regno' => $this->faker->sentence,
            'name' => $this->faker->company(),
            'address' => $this->faker->address,
            'brno' => $this->faker->randomDigit(1, 11),
            'debtor_limit' => '1000',
            'status' => 0,
        ];
        $response = $this->json('POST', '/api/v1/companies', $data);
        $response->assertStatus(201)
            ->assertJson(compact($data));
       /* $this->assertDatabaseHas('companies', [
            'uuid' => $data['uuid'],
            'regno' => $data['regno'],
            'company' => $data['company'],
            'address' => $data['address'],
            'brno' => $data['brno'],
            'debtor_limit' => $data['debtor_limit'],
            'status' => $data['status'],
        ]);*/
    }
}
