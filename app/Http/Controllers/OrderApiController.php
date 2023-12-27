<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OrderApiController extends Controller
{
    public function order()
    {
        $order = Order::create([
            'customer_id'=>request('customer_id'),
            'order_total'=>request('order_total'),
            'payment_method'=>request('payment_method'),
            'trxID'=>request('trxID'),
         
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Order CReated',
            'order' => $order
        ]);
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
