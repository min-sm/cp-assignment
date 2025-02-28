<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch top 4 most sold product IDs
        $mostSoldItems = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(4)
            ->pluck('product_id')
            ->toArray();

        // Fetch products in stock from most sold items
        $products = collect();

        if (!empty($mostSoldItems)) {
            $products = Product::whereIn('id', $mostSoldItems)
                ->where('stock_quantity', '>', 0)
                ->orderByRaw("FIELD(id, " . implode(',', $mostSoldItems) . ")")
                ->get();
        }

        // If less than 4 products, fill remaining slots with highest stock products
        if ($products->count() < 4) {
            $additionalProducts = Product::whereNotIn('id', $products->pluck('id')->toArray())
                ->orderByDesc('stock_quantity')
                ->take(4 - $products->count())
                ->get();

            $products = $products->merge($additionalProducts);
        }

        return view('pages.home', compact('products'));
    }
}
