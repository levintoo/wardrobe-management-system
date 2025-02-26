<?php

use App\Models\Category;
use App\Models\ClothingItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('displays dashboard statistics', function () {
    Category::factory()->count(3)->create();
    ClothingItem::factory()->count(10)->create();

    $response = $this->get(route('dashboard'));

    $response->assertOk();
    $response->assertInertia(fn ($page) =>
    $page->component('Dashboard')
        ->has('stats', fn ($stats) =>
        $stats->where('clothing', 10)
            ->where('categories', 13)
            ->etc()
        )
    );
});
