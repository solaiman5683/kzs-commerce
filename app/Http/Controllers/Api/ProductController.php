<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Check for isOnSale parameter
        if ($request->has('isOnSale')) {
            $query->where('isOnSale', $request->input('isOnSale'));
        }

        // Check for featured parameter
        if ($request->has('featured')) {
            $query->where('featured', $request->input('featured'));
        }

        // Check for isNewArrival parameter
        if ($request->has('isNewArrival')) {
            $query->where('isNewArrival', $request->input('isNewArrival'));
        }

        $products = $query->get();

        return response()->json(['data' => ProductResource::collection($products)]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['data' => new ProductResource($product)]);
    }
}
