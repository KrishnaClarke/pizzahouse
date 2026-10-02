<?php

namespace Database\Factories;

use App\Models\Pizza;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Pizza> */
class PizzaFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(array_keys(Pizza::TYPES));
        $base = fake()->randomElement(array_keys(Pizza::CRUSTS));
        $toppings = fake()->randomElements(Pizza::TOPPINGS, fake()->numberBetween(0, 3));

        return [
            'name' => fake()->firstName(),
            'type' => $type,
            'base' => $base,
            'toppings' => $toppings,
            'price' => Pizza::calculatePrice($type, $base, $toppings),
            'status' => Pizza::STATUS_PENDING,
        ];
    }

    public function completed(): static
    {
        return $this->state(['status' => Pizza::STATUS_COMPLETED]);
    }
}
