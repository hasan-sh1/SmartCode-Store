<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = ucfirst($this->faker->unique()->words(3, true));
        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::random(4),
            'sku' => strtoupper(Str::random(8)),
            'description' => $this->faker->optional()->paragraphs(2, true),
            'price' => $this->faker->randomFloat(2, 5, 499),
            'stock' => $this->faker->numberBetween(0, 100),
            'image_path' => $this->faker->imageUrl(600, 400, true),
            'is_active' => true,
        ];
    }
}
