<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $company = Company::first();

        return [
            'company_id' => $company->id,
            'name' => $this->faker->name,
            'document' => $this->faker->numberBetween($min = 10000000000, $max = 99999999999),
            'phone' => $this->faker->numberBetween($min = 86988000000, $max = 86999999999),
            'phone_secondary' => $this->faker->numberBetween($min = 86988000000, $max = 86999999999),
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
