<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->catchPhrase();
        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(4),
            'description' => $this->faker->optional()->paragraphs(2, true),
            'code_url' => $this->faker->optional()->url(),
            'price' => $this->faker->randomFloat(2, 10, 999),
            'attachment_path' => null,
            'is_active' => true,
        ];
    }
}
