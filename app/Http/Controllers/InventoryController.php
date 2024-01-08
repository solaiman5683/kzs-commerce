<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function inventory()
    {
        //
        $inventory = Inventory::with('product')->get();
        // dd($inventory);
        return view('inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function editInventory($id)
    {
        //
        $inventory = Inventory::with('product')->find($id);
        // dd($inventory);
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateInventory(Request $request)
    {
        //
        $request->validate([
            'quantity' => 'string',
            'purchase_price' => 'string',
        ]);

        $inventory = Inventory::find($request->id);
        $inventory->quantity = $request->quantity;
        $inventory->purchase_price = $request->purchase_price;
        $inventory->save();

        session()->flash('success', 'Inventory updated successfully');

        return redirect()->route('second', ['inventory', 'index']);
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
