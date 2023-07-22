<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $name = $this->Faker->words(2 , true);
        return [
            'name' => $name ,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentance(15),
            'cover_image' => $this->Faker->imageUrl,
            'price' => $this->faker->randomFloat(1,1,499),
            'compare_price' => $this->faker->randomFloat(1,500,999),
            'category_id'   => Category::inRandomOrder()->first()->id ,
            'store_id' => Store::inRandomOrder()->first()->id,
       ];
    }
}
