<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all orders
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        // Retrieve a specific order by ID
        $order = Order::findOrFail($id);

        return view('orders.show', ['order' => $order]);
    }

    public function create()
    {
        // Show the form to create a new order
        return view('orders.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new order
        $request->validate([
            // Add validation rules for order creation fields
            'order_total' => 'required|numeric',
            'status' => 'required|string',
            'payment_status' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $order = Order::create($request->all());

        return redirect()->route('orders.show', ['order' => $order->id]);
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
}
