<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ClothingItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClothingItemFactory extends Factory
{
    protected $model = ClothingItem::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'size' => fake()->word(),
            'price' => fake()->word(),
            'image_path' => fake()->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'category_id' => Category::factory(),
        ];
    }
}
