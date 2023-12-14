<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(new CategoryResource($category));
    }
}
