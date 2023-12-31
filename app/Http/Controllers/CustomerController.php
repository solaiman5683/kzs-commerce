<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::with('orders','user:id,name,email')->get();
        // dd($customers);
        $users = User::find(18)->with('customer')->first();
        dd($users->customer);
        return view('customers.index', compact('customers'));
    }
    public function createCustomer()
    {
        $users = User::all('id', 'name', 'email');
        return view('customers.create', compact('users'));
    }

    public function storeCustomer(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:customers,user_id',
            'shipping_address_line1' => 'required',
            'shipping_address_line2' => 'nullable',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zipcode' => 'required',
            'shipping_country' => 'required',
            'billing_address_line1' => 'nullable',
            'billing_address_line2' => 'nullable',
            'billing_city' => 'nullable',
            'billing_state' => 'nullable',
            'billing_zipcode' => 'nullable',
            'billing_country' => 'nullable',
            'phone' => 'required',
            'alternate_phone' => 'nullable',
        ]);

        try {
            $customer = Customer::create($request->all());
            session()->flash('success', 'Customer created successfully. Id: ' . $customer->id);
        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. ' . $e->getMessage());

            return redirect()->back()->withInput();
        }

        return redirect()->route('second', ['customers', 'create']);
    }
}
