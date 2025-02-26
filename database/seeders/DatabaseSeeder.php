<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ClothingItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = [
            'Tops',
            'Bottoms',
            'Footwear',
        ];

        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }

        $categoryIds = Category::pluck('id', 'name')->toArray();

        $clothingItems = [
            'Tops' => ['T-shirt', 'Hoodie', 'Blouse', 'Sweater', 'Tank Top', 'Polo Shirt', 'Cardigan'],
            'Bottoms' => ['Jeans', 'Shorts', 'Skirt', 'Trousers', 'Leggings', 'Joggers', 'Cargo Pants'],
            'Footwear' => ['Sneakers', 'Boots', 'Sandals', 'Loafers', 'Flip Flops', 'Heels', 'Running Shoes'],
        ];

        foreach (range(1, 16) as $index) {
            $categoryName = array_rand($clothingItems);
            ClothingItem::factory()->create([
                'category_id' => $categoryIds[$categoryName],
                'name' => fake()->randomElement($clothingItems[$categoryName]),
                'description' => fake()->sentence(),
            ]);
        }
    }
}
