<?php

namespace Tests;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase,WithFaker;
    protected $faker;

    public function tearUp(){
        parent::setUp();
        $this->faker = Faker::create();
        Artisan::call('migrate'); // runs the migration
    }


    /**
     * Rolls back migrations
     */
    public function tearDown(): void
    {
        Artisan::call('migrate:rollback');
        parent::tearDown();
    }
}
