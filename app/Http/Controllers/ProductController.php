<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.index', ['request' => []]);
    }

    public function show($slug)
    {
        $product = Product::with(['images', 'category', 'series.brand'])
            ->where('slug', $slug)
            ->firstOrFail();
        Debugbar::info($product);
        return view('pages.products.show', compact('product'));
    }

    public function filter(Request $request)
    {
        return view('pages.products.index', ['request' => $request->all()]);
    }
}
