<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClothingItemRequest;
use App\Http\Resources\ClothingItemResource;
use App\Models\ClothingItem;

class ClothingItemController extends Controller
{
    public function index()
    {
        return ClothingItemResource::collection(ClothingItem::all());
    }

    public function store(ClothingItemRequest $request)
    {
        return new ClothingItemResource(ClothingItem::create($request->validated()));
    }

    public function show(ClothingItem $clothingItem)
    {
        return new ClothingItemResource($clothingItem);
    }

    public function update(ClothingItemRequest $request, ClothingItem $clothingItem)
    {
        $clothingItem->update($request->validated());

        return new ClothingItemResource($clothingItem);
    }

    public function destroy(ClothingItem $clothingItem)
    {
        $clothingItem->delete();

        return response()->json();
    }
}
