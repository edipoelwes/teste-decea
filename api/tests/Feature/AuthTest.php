<?php

namespace Tests\Feature;

use App\Models\{Company, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /** @test */
    public function createCompanyAndUserSuccess()
    {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var Company $company */
        $company = Company::factory()->make();

        $this->post(route('register'),
        array_merge($user->toArray(), $company->toArray(), ['password' => '123456']))
            ->assertSuccessful();
    }

    /** @test */
    public function createCompanyAndUserFail()
    {
        /** @var User $user */
        $user = User::factory()->make();

        /** @var Company $company */
        $company = Company::factory()->make();

        $this->post(route('register'),
        array_merge($user->toArray(), $company->toArray()))
            ->assertStatus(500);
    }

    /** @test */
    public function loginUnauthorized()
    {
        $credentials = [
            'email' => 'teste@gmail.com',
            'password' => 'error'
        ];

        $response = $this->post(route('login'), $credentials);

        $response
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /** @test */
    public function loginSuccess()
    {
        $credentials = [
            'email' => 'teste@gmail.com',
            'password' => '123456'
        ];

        $this->post(route('login'), $credentials)
            ->assertSuccessful();
    }
}
