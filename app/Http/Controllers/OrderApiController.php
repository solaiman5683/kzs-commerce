<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OrderApiController extends Controller
{
    public function order()
    {
        $customerId = request('customerId');
        if(request()->has('customerId') && request('customerId') === null){
            try {
                $customer = Customer::create([
                    'user_id' => request('userId'),
                    'shipping_address_line1' => request('address'),
                    'shipping_city' => request('city'),
                    'shipping_zipcode' => request('zipCode'),
                    'phone' => request('phone'),
                    'alternate_phone' => request('phone'),
                ]);

                if (!$customer) {
                    return $this->errorResponse('Customer registration failed.', 400);
                } else {
                    $customerId = $customer->id;
                }
            } catch (\Exception $e) {
                return $e;
            }
        }

        $orderData = $this->transformCartToOrderArray(request('cart'), $customerId);

        try {
            $order = new Order([
                'customer_id' => $orderData['customer_id'],
                'order_total' => $orderData['total'],
                'payment_method' => 'Cash on delivery',
            ]);

            $order->save();

            foreach ($orderData['products'] as $key => $productId) {
                $quantity = $orderData['quantities'][$productId];

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

            return response()->json([
                'status' => 'ok',
                'message' => 'Order created successfully.',
                'success' => true,
                'order' => $order,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order could not be created.',
                'success' => false,
                'error' => $e,
            ], 500);
        }

    }

    protected function transformCartToOrderArray(array $cart, $customerId)
    {
        $orderArray = [
            'customer_id' => $customerId,
            'products' => [],
            'total' => 0,
            'quantities' => [],
        ];

        foreach ($cart as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];

            // Add product ID to the 'products' array
            $orderArray['products'][] = $productId;

            // Add quantity to the 'quantities' array
            $orderArray['quantities'][$productId] = $quantity;

            // Calculate and update the total
            $orderArray['total'] += $item['itemTotal'];
        }

        return $orderArray;
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
