<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Step 1: Get the most sold items
        $mostSoldItems = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(4)
            ->pluck('product_id');

        // Step 2: Check stock availability and get the products
        $products = Product::whereIn('id', $mostSoldItems)
            ->where('stock_quantity', '>', 0)
            ->orderByRaw("FIELD(id, " . implode(',', $mostSoldItems->toArray()) . ")")
            ->get();

        // Step 3: If less than 4 products, fill the rest with products having the highest stock quantities
        if ($products->count() < 4) {
            $remainingCount = 4 - $products->count();
            $additionalProducts = Product::whereNotIn('id', $products->pluck('id'))
                ->orderByDesc('stock_quantity')
                ->take($remainingCount)
                ->get();

            $products = $products->merge($additionalProducts);
        }

        return view('pages.home', compact('products'));
    }
}
