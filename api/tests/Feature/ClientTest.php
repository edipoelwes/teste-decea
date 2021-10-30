<?php

namespace Tests\Feature;

use App\Models\{Client, Company, User};
use Database\Seeders\{CompanySeeder, UserSeeder};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientTest extends TestCase
{
    protected function authenticate($email = 'teste@gmail.com', $password = '123456')
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        return $this->post(route('login'), $credentials);

    }

    /** @test */
    public function createClient()
    {
        $data = $this->authenticate();

        $company = Company::find(1);

        /** @var Client $client */
        $client = Client::factory()->make(['token' => $data['token']]);

        $this->post(route('clients.store'), $client->toArray())
            ->assertStatus(201)
            ->assertJson([
                'name' => $client->name,
            ]);

    }
}
