<?php

use App\Models\Category;
use App\Models\ClothingItem;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    \Pest\Laravel\actingAs(User::factory()->create());
    Category::factory()->create(['id' => 1, 'name' => 'Default Category']);
});

it('displays the clothing items index page with all items', function () {
    ClothingItem::factory()->count(3)->create();

    $response = $this->get(route('clothing.index'));

    $response->assertOk();
    $response->assertSee(ClothingItem::all()->pluck('name')->toArray());
});

it('displays the clothing item creation page', function () {
    $response = $this->get(route('clothing.create'));

    $response->assertOk();
});

it('creates a new clothing item', function () {
    Storage::fake('public');

    $response = $this->post(route('clothing.store'), [
        'name' => 'New Clothing Item',
        'description' => 'A nice description',
        'category_id' => 1,
    ]);

    $response->assertRedirect(route('clothing.index'));
});

it('displays the edit page for a clothing item', function () {
    $clothingItem = ClothingItem::factory()->create();

    $response = $this->get(route('clothing.edit', $clothingItem));

    $response->assertOk();
    $response->assertSee($clothingItem->name);
});

it('updates a clothing item', function () {
    $clothingItem = ClothingItem::factory()->create(['name' => 'Old Name']);

    $response = $this->post(route('clothing.update', $clothingItem), [
        'name' => 'Updated Name',
        'description' => 'Updated description',
        'category_id' => 1,
    ]);

    $response->assertRedirect(route('clothing.index'));
    $this->assertDatabaseHas('clothing_items', ['id' => $clothingItem->id, 'name' => 'Updated Name']);
});

it('deletes a clothing item', function () {
    $clothingItem = ClothingItem::factory()->create();

    $response = $this->delete(route('clothing.delete', $clothingItem));

    $response->assertRedirect(route('clothing.index'));
});

it('validates the clothing item creation request', function () {
    $response = $this->post(route('clothing.store'), [
        'name' => '',
        'category_id' => null,
        'image' => UploadedFile::fake()->create('document.pdf', 500, 'application/pdf'),
    ]);

    $response->assertSessionHasErrors(['name', 'category_id', 'image']);
});

it('validates the clothing item update request', function () {
    $clothingItem = ClothingItem::factory()->create();

    $response = $this->post(route('clothing.update', $clothingItem), [
        'name' => '',
        'category_id' => null,
    ]);

    $response->assertSessionHasErrors(['name', 'category_id']);
});
