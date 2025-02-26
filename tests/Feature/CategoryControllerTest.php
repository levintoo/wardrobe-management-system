<?php

use App\Models\Category;
use App\Models\User;

beforeEach(fn () => \Pest\Laravel\actingAs(User::factory()->create()));

it('displays the category index page with all categories', function () {
    Category::factory()->count(3)->create();

    $response = $this->get(route('category.index'));

    $response->assertOk();
});

it('displays the category creation page', function () {
    $response = $this->get(route('category.create'));

    $response->assertOk();
});

it('creates a new category', function () {
    $response = $this->post(route('category.store'), [
        'name' => 'New Category',
    ]);

    $response->assertRedirect(route('category.index'));
    $this->assertDatabaseHas('categories', ['name' => 'New Category']);
});

it('displays the edit page for a category', function () {
    $category = Category::factory()->create();

    $response = $this->get(route('category.edit', $category));

    $response->assertOk();
    $response->assertSee($category->name);
});

it('updates a category', function () {
    $category = Category::factory()->create(['name' => 'Old Name']);

    $response = $this->patch(route('category.update', $category), [
        'name' => 'Updated Name',
    ]);

    $response->assertRedirect(route('category.index'));
    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Name']);
});

it('deletes a category', function () {
    $category = Category::factory()->create();

    $response = $this->delete(route('category.delete', $category));

    $response->assertOk();
});

it('validates the category creation request', function () {
    $response = $this->post(route('category.store'), []);

    $response->assertSessionHasErrors(['name']);
});

it('validates the category update request', function () {
    $category = Category::factory()->create();

    $response = $this->patch(route('category.update', $category), [
        'name' => '',
    ]);

    $response->assertSessionHasErrors(['name']);
});
