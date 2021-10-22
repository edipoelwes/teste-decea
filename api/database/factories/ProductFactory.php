<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Product::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $categorias = ['fraldas', 'lencos_umedecidos', 'calcados', 'roupinha'];
    return [
      'company_id' => 1,
      'category' => $this->faker->randomElement($categorias),
      'name' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
      'price' => $this->faker->randomFloat(1, 2, 10),
      'amount' => 0,
      'min_amount' => $this->faker->randomDigitNotNull,
    ];
  }
}
