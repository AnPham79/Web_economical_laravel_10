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
    public function definition(): array
    {
        $name_product = $this->faker->name();
        $slug_name_product = Str::slug($name_product);
        return [
            'product_name' => $name_product,
            'product_slug_name' => $slug_name_product,
            'product_short_description' => $this->faker->text(100),
            'product_description' => $this->faker->text(300),
            'product_regular_price' => $this->faker->numberBetween(300000, 1000000),
            'product_SKU' => $this->faker->word($nb=1, $astext=true),
            'stock_status' => 'in_stock',
            'product_quantity' => 10,
            'product_image' => 'product-' . $this->faker->unique()->numberBetween(1, 28) . '.jpg',
            'category_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
