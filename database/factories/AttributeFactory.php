<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    private $index = 0;

    public function definition()
    {
        $keys = [
            'color',
            'weight',
            'height',
            'length',
            'width'
        ];

        if($this->index > 4) $this->index = 0;
        
        return [
            'value' => $this->index == 0 ? $this->faker->colorName() : $this->faker->biasedNumberBetween(5,50),
            'key' => $keys[$this->index++]
        ];
    }
}
