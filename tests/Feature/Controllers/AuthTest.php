<?php

use Laravel\Sanctum\Sanctum;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs( $this->user);
});
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);
it('has check for credentials', function () {
    $this->json('POST', 'api/v1/login', [
        'email' => 'abc@gmail.com',
    ])->assertInvalid(['password'])
        ->assertStatus(422);

    $this->json('POST', 'api/v1/login', [
        'passwordd' => 'testpassword',
    ])->assertInvalid(['password'])
        ->assertStatus(422);
});
it('has check for wrong credentials', function () {
    $this->json('POST', 'api/v1/login', [
        'email' => 'abc@gmail.com',
        'password' => 'password',
    ])->assertStatus(400);
});
it('can login with correct credentials', function () {
    //$user = User::factory()->create();
    $this->json('POST', 'api/v1/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ])
        ->assertOk()
        ->assertJsonStructure([
            'access_token',
        ]);
});

it('can log out successfully', function () {

    $this->json('POST', 'api/v1/logout')->assertOk();

    $this->assertEquals(0, $this->user->tokens()->count());
});
