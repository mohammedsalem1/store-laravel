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
    public function definition()
    {
        $name = $this->Faker->words(2 , true);
        return [
            'name' => $name ,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentance(15),
            'image' => $this->Faker->imageUrl,
       ];
    }
}
