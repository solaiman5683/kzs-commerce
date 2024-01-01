<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OrderApiController extends Controller
{
    public function order()
    {
        $request = request();
        // return request()->has('customerId');
        if(request()->has('customerId') && request('customerId') === null){

                $customer = Customer::create([
                    'user_id' => request('userId'),
                    'shipping_address_line1' => request('address'),
                    'shipping_city' => request('city'),
                    'shipping_zipcode' => request('zipCode'),
                    'phone' => request('phone'),
                    'alternate_phone' => request('phone'),
                ]);

                return response()->json($customer);
            }else {
                return response()->json($request);
            }
        }

    
    //orderGet
    public function orderGet()
    {
        try {
            $user = JWTAuth::user();
            $customerOrder = []; // Initialize the variable outside the conditions

            if ($user) {
                $userData = User::select('id')->find($user->id);

                $order = Order::where('customer_id', $userData->id)->first();

                if ($order) {
                    $customerId = $order->customer_id;
                    $customerOrder = Order::where('customer_id', $customerId)->get();
                }
            }
        } catch (\Exception $e) {
            return $e;
        }
        return response()->json([
            'order'=>$customerOrder,
        ],200);
    }
}
