<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => Str::random(20) . " " . Str::random(5),
            'price' => 2000,
            'price_discount' => 1500,
            'image' => 'http://www.splash.com/img.png',
            'short_description' => Str::random(20),
            'long_description' => Str::random(30),
        ];
    }
}