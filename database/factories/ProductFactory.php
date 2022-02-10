<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $suffix = [
            'Watch',
            'Display',
            'Laptop',
            'Table',
            'Chair',
            'Shelf',
            'Fridge',
            'Shoe',
            'T-shirt',
            'Pen',
            'Lamp'
        ];
        return [
            'name' => $this->faker->company() . ' ' . Arr::random($suffix),
            'description' => $this->faker->text()
        ];
    }
}
