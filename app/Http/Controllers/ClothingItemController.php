<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClothingItemRequest;
use App\Http\Resources\ClothingItemResource;
use App\Models\Category;
use App\Models\ClothingItem;
use Illuminate\Support\Facades\File;

class ClothingItemController extends Controller
{
    public function index()
    {
        request()->validate([
            'direction' => 'in:desc,asc',
            'field' => 'in:name,created_at',
            'category' => 'exists:categories,id',
            'search' => 'max:25'
        ]);

        $query = ClothingItem::query();

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('description', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('category_id', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('size', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('price', 'LIKE', '%' . request('search') . '%');
            });
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

        $query->with('category:id,name');

        $query->select([
            'id',
            'name',
            'description',
            'category_id',
            'size',
            'price',
            'image_path',
            'created_at',
        ]);

        $clothing = $query->paginate()->through(fn($clothingitem) => [
            'id' => $clothingitem->id,
            'name' => $clothingitem->name,
            'description' => $clothingitem->description,
            'category' => $clothingitem->category->name,
            'image_path' => $clothingitem->image_path,
            'created_at' => $clothingitem->created_at->diffForHumans(),
        ]);

        $filters = request()->all(['field', 'search', 'direction', 'category']);

        $categories = Category::query()->select(['id', 'name'])->get();

        return inertia('Clothing/Index', compact('clothing', 'filters', 'categories'));
    }

    public function create()
    {
        $categories = Category::query()->select(['id', 'name'])->get();
        return inertia('Clothing/Create', compact('categories'));
    }

    public function store(ClothingItemRequest $request)
    {
        $filePath = $request->file('image')?->move( time() . '.' . $request->file('image')->getClientOriginalExtension());

        ClothingItem::create([
            ...$request->validated(),
            'image_path' => $filePath ?? null,
        ]);

        return redirect()->route('clothing.index');
    }

    public function show(ClothingItem $clothingItem)
    {
        $categories = Category::query()->select(['id', 'name'])->get();

        return inertia('Clothing/Edit', compact('clothingItem', 'categories'));
    }

    public function update(ClothingItemRequest $request, ClothingItem $clothingItem)
    {
        $filePath = $clothingItem->image_path;

        if ($request->file('image')) {
            if ($filePath && File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
            }

            $filePath = $request->file('image')->move(
                'uploads',
                time() . '.' . $request->file('image')->getClientOriginalExtension()
            );
        }

        $clothingItem->update([
            ...$request->validated(),
            'image_path' => $filePath ?? null,
        ]);

        return redirect()->route('clothing.index');
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $clothingItem->delete();

        return redirect()->route('clothing.index');
    }
}
