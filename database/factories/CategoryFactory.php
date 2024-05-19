<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_name = $this->faker->unique()->words($nb=2, $asText=true);
        $category_slug_name = Str::slug( $category_name);

        return [
            'category_name' => $category_name,
            'category_slug_name' => $category_slug_name
        ];
    }
}
