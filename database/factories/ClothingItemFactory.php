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
            'name' => fake()->word(),
            'description' => fake()->realText(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'category_id' => Category::factory(),
        ];
    }
}
