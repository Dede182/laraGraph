<?php

namespace Tests;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->tenUsers();
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    public function tenUsers()
    {
        return User::factory()->count(10)->create();
    }

    public function AuthUser()
    {
        $user = $this->createUser();
        Passport::actingAs($user);
        return $user;
    }

    public function createEmployee($args = [])
    {
        return Employee::factory()->create($args);
    }




}
