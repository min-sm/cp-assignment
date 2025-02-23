<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.index', ['request' => []]);
    }

    public function show($slug)
    {
        // Fetch the product with its related images, category, and series.brand
        $product = Product::with(['images', 'category', 'series.brand'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Initialize an empty collection for the related products
        $products = collect();

        // First, try to get products with the same category and brand
        $sameCategoryAndBrand = Product::where('category_id', $product->category_id)
            ->whereHas('series', function ($query) use ($product) {
                $query->where('brand_id', $product->series->brand_id);
            })
            ->where('id', '!=', $product->id) // Exclude the current product
            ->where('stock_quantity', '>', '0')
            ->take(4)
            ->get();

        $products = $products->merge($sameCategoryAndBrand);

        // If we still need more products, get products with the same category
        if ($products->count() < 4) {
            $sameCategory = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id) // Exclude the current product
                ->whereNotIn('id', $products->pluck('id')) // Exclude already fetched products
                ->take(4 - $products->count())
                ->get();

            $products = $products->merge($sameCategory);
        }

        // If we still need more products, get products with the same brand
        if ($products->count() < 4) {
            $sameBrand = Product::whereHas('series', function ($query) use ($product) {
                $query->where('brand_id', $product->series->brand_id);
            })
                ->where('id', '!=', $product->id) // Exclude the current product
                ->whereNotIn('id', $products->pluck('id')) // Exclude already fetched products
                ->take(4 - $products->count())
                ->get();

            $products = $products->merge($sameBrand);
        }

        // Debug the product and related products
        Debugbar::info($product);
        Debugbar::info($products);

        // Pass the product and related products to the view
        return view('pages.products.show', compact('product', 'products'));
    }

    public function filter(Request $request)
    {
        return view('pages.products.index', ['request' => $request->all()]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'model' => 'required',
            'brand' => 'required|exists:brands,id',
            'series' => [
                Rule::exists('series', 'id')->where(function ($query) use ($request) {
                    return $query->where('brand_id', $request->brand);
                }),
            ],
            'category' => 'required|exists:categories,id',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'series_id' => 'required|exists:series,id',
        ], [
            'series.exists' => 'The selected series does not belong to the chosen brand.',
        ]);

        // Create a new product
        Product::create($request->all());

        // Redirect to the products index page
        return redirect()->route('admin.products');
    }
}
