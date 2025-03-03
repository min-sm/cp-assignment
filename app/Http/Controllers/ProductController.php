<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('pages.products.index', ['request' => []]);
    }

    public function show($slug)
    {
        // Fetch the product
        $product = $this->productRepository->findBySlug($slug);

        // Get related products
        $relatedProducts = $this->productRepository->getRelatedProducts($product);

        // Pass data to view
        return view('pages.products.show', [
            'product' => $product,
            'products' => $relatedProducts
        ]);
    }

    public function filter(Request $request)
    {
        return view('pages.products.index', ['request' => $request->all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required',
            'brand' => 'required|exists:brands,id',
            'series' => [
                'nullable',
                Rule::exists('series', 'id')->where(fn($query) => $query->where('brand_id', $request->brand)),
            ],
            'category' => 'required|exists:categories,id',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:1',
            'files' => 'sometimes|array|max:5',
            'files.*' => 'file|mimes:jpg,jpeg,png|max:2048',
        ], [
            'series.exists' => 'The selected series does not belong to the chosen brand.',
        ]);

        $product = Product::create([
            'model' => $request->model,
            'series_id' => $request->series ?? null,
            'brand_id' => $request->brand,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->quantity,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store("img/products/{$product->id}", 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
