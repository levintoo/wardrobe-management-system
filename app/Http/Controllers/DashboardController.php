<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClothingItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'clothing' => ClothingItem::count(),
            'categories' => Category::count(),
        ];

        return inertia('Dashboard', compact('stats'));
    }
}
