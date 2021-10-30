<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'company_id'     => 1,
                'name'           => 'Teste',
                'document'       => '44476379010',
                'phone'          => '86999097714',
                'email'          => 'teste@gmail.com',
                'password'       => bcrypt('123456'),
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
