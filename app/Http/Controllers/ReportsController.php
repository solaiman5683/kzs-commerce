<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve flashed 'orders' data from the session
        $orders = session('orders');

        // If 'orders' data is not present in the session, fetch fresh data from the database
        if (empty($orders)) {
            $orders = Order::with('products')->orderBy('created_at', 'desc')->get();
        }

        return view('reports.index', compact('orders'));
    }

    public function dateRange()
    {
        $startDate = request('start-date');
        $endDate = request('end-date');

        $orders = Order::with('products')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        return redirect()->route('second', ['reports', 'index'])->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
