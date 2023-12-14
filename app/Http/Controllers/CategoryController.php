<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $products = Category::all();
        // dd($products);
        return view('product');
    }

    public function categories()
    {
        $categories = Category::with('products', 'subcategories')->whereNull('parent_id')->get();

        // Load subcategories recursively
        $categories->each(function ($category) {
            $category->load('subcategories');
        });

        return view('categories.index', compact('categories'));
    }

    public function createCategory()
    {
        $categories = Category::all();
        // dd($categories);
        return view('categories.create', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        try {
            // Upload the 'image' file to the 'uploads' folder
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Upload the 'icon' file to the 'uploads' folder, if provided
            $iconPath = null;
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('uploads', 'public');
            }

            // Create a new Category instance and fill it with the validated data
            $category = new Category([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' => $imagePath,
                'icon' => $iconPath,
            ]);

            // Save the category to the database
            $category->save();

            // Attach parent category, if provided
            if ($request->has('parent_id')) {
                $parentCategory = Category::find($request->input('parent_id'));
                if ($parentCategory) {
                    $category->parent()->associate($parentCategory);
                    $category->save();
                }
            }

            // Set success message
            session()->flash('success', 'Category added successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error adding category: ' . $e->getMessage());
        }

        // Redirect to the 'categories' route
        return redirect()->route('second', ['categories', 'create']);
    }




    public function showCategory($id)
    {
        $product = Category::find($id);
        return view('products.show', compact('product'));
    }

    public function editCategory($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        return view('categories.edit', compact('categories', 'category'));
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $product = Category::find($id);

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

            // Set success message
            session()->flash('success', 'Category updated successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error updating product: ' . $e->getMessage());
        }

        // Redirect to the 'products' route
        return redirect()->route('third', ['products', $id, 'edit']);
    }



    public function deleteCategory($id)
    {
        // dd($id);
        try {
            $product = Category::find($id);
            $product->delete();
            session()->flash('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            // Set error message
            session()->flash('error', 'Error deleting product: ' . $e->getMessage());
        }


        return redirect()->route('products');
    }
}
