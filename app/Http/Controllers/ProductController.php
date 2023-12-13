<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::all();
        dd($products);
        return view('product');
    }

    public function products()
    {
        $products = Product::with('category')->get();
        // dd($products);
        return view('products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        // dd($categories);
        return view('products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif',
            'price' => 'required|string',
            'sale_price' => 'required|string',
            'isNewArrival' => 'nullable|in:on,off',
            'featured' => 'nullable|in:on,off',
            'isOnSale' => 'nullable|in:on,off',
        ]);

        try {
            // Upload the 'image' file to the 'uploads' folder
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Upload each file in the 'gallery' array to the 'uploads' folder
            $galleryPaths = [];
            foreach ($request->file('gallery') as $galleryFile) {
                $galleryPaths[] = $galleryFile->store('uploads', 'public');
            }

            // Create a new Product instance and fill it with the validated data
            $product = new Product([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => $request->slug,
                'category_id' => $request->category_id,
                'image' => $imagePath,
                'gallery' => json_encode($galleryPaths),
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'isNewArrival' => $request->isNewArrival == 'on' ? 'true' : 'false' ,
                'featured' => $request->featured == 'on' ? 'true' : 'false',
                'isOnSale' => $request->isOnSale == 'on' ? 'true' : 'false',
            ]);

            // Save the product to the database
            $product->save();

            // Set success message
            session()->flash('success', 'Product added successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error adding product: ' . $e->getMessage());
        }

        // Redirect to the 'products' route
        return redirect()->route('second', ['products', 'create']);
    }

    public function showProduct($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('products');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products');
    }
}
