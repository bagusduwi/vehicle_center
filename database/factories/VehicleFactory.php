<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'ownership' => $this->faker->numberBetween(0, 1),
            'year' => $this->faker->year(),
            'vin' => $this->faker->randomDigit(),
            'status' => $this->faker->numberBetween(0, 1),
            'information' => $this->faker->text()
        ];
    }
}
