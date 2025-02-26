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

        Category::factory()->create(['name' => 'Tops']);
        Category::factory()->create(['name' => 'Bottoms']);
        Category::factory()->create(['name' => 'Shoes']);

//        ClothingItem::factory(10)->create();
    }
}
