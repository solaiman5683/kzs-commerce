<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Variation;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('product');
    }

    public function products()
    {
        $products = Product::with('categories', 'inventory')->get();
        // dd($products);
        return view('products.index', compact('products'));
    }

    public function createProduct()
    {

        $attributes = Attribute::with('variations')->get();
        $categories = Category::all();
        // dd($attributes);
        return view('products.create', compact('categories','attributes'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'categories' => 'required|array|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif',
            'purchase_price' => 'required|string',
            'price' => 'required|string',
            'sale_price' => 'required|string',
            'isNewArrival' => 'nullable|in:on,off',
            'featured' => 'nullable|in:on,off',
            'isOnSale' => 'nullable|in:on,off',
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            // Upload the 'image' file to the 'uploads' folder
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Upload each file in the 'gallery' array to the 'uploads' folder
            $galleryPaths = [];
            if ($request->has('gallery')) {
                foreach ($request->file('gallery') as $galleryFile) {
                    $galleryPaths[] = $galleryFile->store('uploads', 'public');
                }
            }

            // Create a new Product instance and fill it with the validated data
            $product = new Product([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => $request->slug,
                // 'variation_id' => $request->variation_id,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'isNewArrival' => $request->has('isNewArrival') ? 'true' : 'false',
                'featured' => $request->has('featured') ? 'true' : 'false',
                'isOnSale' => $request->has('isOnSale') ? 'true' : 'false',
                'image' => $imagePath, // Set the image path here
                'gallery' => json_encode($galleryPaths),
                // 'attribute' => json_encode($request->attributes),
            ]);

            // dd($request->all());

            // Save the product to the database
            $product->save();

            // Create a new Inventory instance and fill it with the product information
            $inventory = new Inventory([
                'product_id' => $product->id,
                'purchase_price' => $request->purchase_price,
                'quantity' => $request->quantity,
            ]);

            // Save the inventory record to the database
            $inventory->save();

            // Attach categories to the product
            $product->categories()->attach($request->input('categories'));
            $product->variations()->attach($request->input('attributes'));


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
        $product = Product::with('inventory')->find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $product = Product::find($id);

            // Validate only the fields that are present in the request
            $request->validate([
                'name' => 'string',
                'description' => 'string',
                'slug' => 'string',
                'categories' => 'array|exists:categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'gallery' => 'nullable|array',
                'gallery.*' => 'image|mimes:jpeg,png,jpg,gif',
                'price' => 'string',
                'sale_price' => 'string',
                'purchase_price' => 'string',
                'isNewArrival' => 'nullable|in:on,off',
                'featured' => 'nullable|in:on,off',
                'isOnSale' => 'nullable|in:on,off',
            ]);

            // Fill the product with the validated request data
            $product->fill($request->only([
                'name', 'description', 'slug', 'price', 'sale_price',
                'isNewArrival', 'featured', 'isOnSale',
            ]));

            // Handle image update
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads', 'public');
                $product->image = $imagePath;
            }

            // Handle gallery update
            if ($request->has('gallery')) {
                $galleryPaths = [];
                foreach ($request->file('gallery') as $galleryFile) {
                    $galleryPaths[] = $galleryFile->store('uploads', 'public');
                }
                $product->gallery = json_encode($galleryPaths);
            }

            $product->isNewArrival = $request->has('isNewArrival') ? 'true' : 'false';
            $product->featured = $request->has('featured') ? 'true' : 'false';
            $product->isOnSale = $request->has('isOnSale') ? 'true' : 'false';

            // Save changes
            $product->save();

            // Sync categories
            if ($request->has('categories')) {
                $product->categories()->sync($request->input('categories'));
            }

            if($request->has('purchase_price')){
                $inventory = Inventory::where('product_id', $id)->first();
                $inventory->purchase_price = $request->purchase_price;
                $inventory->save();
            }

            // Set success message
            session()->flash('success', 'Product updated successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error updating product: ' . $e->getMessage());
        }

        // Redirect to the 'products' route
        return redirect()->route('third', ['products', $id, 'edit']);
    }



    public function deleteProduct($id)
    {
        // dd($id);
        try {
            $product = Product::find($id);
            $product->delete();
            session()->flash('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error deleting product: ' . $e->getMessage());
        }


        return redirect()->route('products');
    }
}
