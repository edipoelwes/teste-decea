<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'social_name' => $this->faker->name,
            'alias_name' => $this->faker->name,
            'document_company' => $this->faker->numberBetween($min = 10000000000000, $max = 99999999999999),
            'document_company_secondary' => $this->faker->numberBetween($min = 10000000, $max = 99999999),
            'zipcode' => $this->faker->numberBetween($min = 64000000, $max = 64099999),
            'street' => $this->faker->streetName,
            'number' => $this->faker->numberBetween($min = 1000, $max = 9999),
            'complement' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'neighborhood' => $this->faker->citySuffix,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
        ];
    }
}
