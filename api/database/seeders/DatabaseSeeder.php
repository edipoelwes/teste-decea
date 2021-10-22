<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      CompanySeeder::class,
      UserSeeder::class,
      ClientSeeder::class,
      ProductSeeder::class,
    ]);
    // \App\Models\Company::factory(10)->create();
  }
}
