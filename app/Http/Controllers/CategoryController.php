<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        request()->validate([
            'direction' => 'in:desc,asc',
            'field' => 'in:name,created_at',
            'search' => 'max:25'
        ]);

        $query = Category::query();

        if(request('search')) {
            $query->where('name','LIKE','%'.request('search').'%');
        }

        if(request('field')) {
            $query->orderBy(
                request('field'), request('direction')
            );
        } else {
            $query->orderBy(
                'created_at','DESC'
            );
        }

        $categories = $query->select(['name', 'id', 'created_at', 'clothingItems_count'])->withCount('clothingItems')->paginate()->through(fn ($category) => [
            'id' => $category->id,
            'name' => $category->name,
            'created_at' => $category->created_at->diffForHumans(),
            'clothing_items_count' => $category->clothing_items_count,
        ]);

        $filters = request()->all(['field', 'search', 'direction']);

        return inertia('Category/Index', compact('categories', 'filters'));
    }

    public function create()
    {
        return inertia('Category/Create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        return inertia('Category/Edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
