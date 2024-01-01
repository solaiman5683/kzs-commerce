<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all orders
        $orders = Order::with('customer.user','products')->get();
        // dd($orders);
        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        // Retrieve a specific order by ID
        $order = Order::findOrFail($id);

        return view('orders.show', ['order' => $order]);
    }

    public function createOrder()
    {
        $products = Product::all();
        $customers = Customer::with('user')->get();
        // dd($customers);
        return view('orders.create', compact('products', 'customers'));
    }

    public function storeOrder(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'products.*' => 'required|exists:products,id',
                'quantities.*' => 'required|integer|min:1',
                'total' => 'required|numeric|min:0',
            ]);

            // Create a new order with the customer_id and total
            $order = new Order([
                'customer_id' => $request->input('customer_id'),
                'order_total' => $request->input('total'),
                // Add other order-related fields if needed
            ]);
            $order->save();

            // Attach products to the order with quantities
            foreach ($request->input('products') as $key => $productId) {
                $quantity = $request->input('quantities.' . $productId);
                // dd($quantity);

                // Ensure that the 'quantity' value is not null or empty
                if ($quantity !== null && $quantity !== '') {
                    $product = Product::findOrFail($productId);
                    $price = $product->sale_price ? $product->sale_price : $product->price;

                    $order->products()->attach($productId, [
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                }
            }

            session()->flash('success', 'Order created successfully.');
        } catch (\Exception $e) {
            // Log the exception message for debugging
            dd($e->getMessage());

            session()->flash('error', 'Order creation failed.');
        }

        // Redirect or respond accordingly
        return redirect()->route('second', ['orders', 'create']);
    }

    public function edit($id)
    {
        // Show the form to edit an existing order
        $order = Order::findOrFail($id);

        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        // Validate and update an existing order
        $order = Order::findOrFail($id);

        $request->validate([
            // Add validation rules for order update fields
            'order_total' => 'required|numeric',
            'status' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.show', ['order' => $order->id]);
    }

    public function destroy($id)
    {
        // Delete an existing order
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index');
    }
    //printOrder
    public function printOrder($id)
    {
        $order = Order::with('customer','products')->find($id);
        return view('orders.printOrder',compact('order'));
    }
}
