<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'code' => $this->faker->unique()->randomNumber(8),
            'status' => 'draft',
            'imported_t' => $this->faker->dateTime(),
            'url' => $this->faker->url,
            'creator' => $this->faker->name,
            'created_t' => $this->faker->dateTime(),
            'last_modified_t' => $this->faker->dateTime(),
            'product_name' => $this->faker->sentence(3),
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'brands' => $this->faker->company,
            'categories' => $this->faker->word,
            'labels' => $this->faker->word,
            'cities' => $this->faker->city,
            'purchase_places' => $this->faker->word,
            'stores' => $this->faker->company,
            'ingredients_text' => $this->faker->sentence(6),
            'traces' => $this->faker->word,
            'serving_size' => $this->faker->randomFloat(2, 0, 100),
            'serving_quantity' => $this->faker->randomFloat(2, 0, 100),
            'nutriscore_score' => $this->faker->randomNumber(2),
            'nutriscore_grade' => $this->faker->randomLetter,
            'main_category' => $this->faker->word,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
