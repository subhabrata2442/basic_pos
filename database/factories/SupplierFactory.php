<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sup_code' => $this->faker->numerify('supplier-####'),
            'sup_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'city' => $this->faker->city(),
            'pin' => $this->faker->postcode(),
            'address' => $this->faker->text(),
        ];
    }
}
