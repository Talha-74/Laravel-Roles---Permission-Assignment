<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Validation rules for placing an order
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
    }
    public function getOrders()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return response()->json(['orders' => $orders], 200);
    }

    public function getSpecificOrder($id)
    {
        $order = Order::where('user_id', auth()->id())->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json(['orders' => $order], 200);
    }
}
