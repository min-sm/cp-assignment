<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:Cash on Delivery,KBZPay',
            'kbzpay_number' => 'nullable|string',
            'total' => 'required|numeric',
        ]);

        // Get the cart from the session
        $cart = session('cart', []);

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(), // Associate the order with the logged-in user
            'total_amount' => $request->total,
            'payment_method' => $request->payment_method,
            'kbzpay_number' => $request->kbzpay_number,
            'status' => 'pending',
        ]);

        // Create order items and reduce stock_quantity
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] * $item['quantity'],
                ]);

                // Reduce stock_quantity
                $product->decrement('stock_quantity', $item['quantity']);
            }
        }

        // Clear the cart session
        session()->forget('cart');

        return redirect()->route('history')->with('success', 'Order placed successfully!');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(20);
        return view('pages.history', compact('orders'));
    }
}
