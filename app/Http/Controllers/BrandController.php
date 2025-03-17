<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Serie;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'series' => 'nullable|array',
            'series.*.name' => 'required|string|max:255',
            'series.*.year' => 'nullable|digits:4',
        ]);

        // Use transaction for data consistency
        DB::beginTransaction();

        try {
            // Create the brand
            $brand = Brand::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'website' => $validated['website'],
            ]);

            // Create associated series
            if (!empty($validated['series'])) {
                foreach ($validated['series'] as $seriesData) {
                    $brand->series()->create([
                        'name' => $seriesData['name'],
                        'launch_year' => $seriesData['year'],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Brand and series created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating brand: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $brand = Brand::with('series')->findOrFail($id);
        // dd($brand->toArray());
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'series' => 'nullable|array',
            'series.*.id' => 'required',
            'series.*.name' => 'required|string|max:255',
            'series.*.year' => 'nullable|digits:4',
        ]);

        DB::beginTransaction();

        try {
            $brand = Brand::findOrFail($id);
            $originalName = $brand->name;

            // Update the brand
            $brand->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'website' => $validated['website'],
            ]);

            // Handle series updates
            $existingSeriesIds = [];

            foreach ($validated['series'] ?? [] as $seriesData) {
                if (!is_numeric($seriesData['id'])) {
                    // Create new series
                    $brand->series()->create([
                        'name' => $seriesData['name'],
                        'launch_year' => $seriesData['year'],
                    ]);
                } else {
                    // Update existing series
                    $series = $brand->series()->findOrFail($seriesData['id']);
                    $series->update([
                        'name' => $seriesData['name'],
                        'launch_year' => $seriesData['year'],
                    ]);
                    $existingSeriesIds[] = $series->id;
                }
            }

            // Delete removed series
            $brand->series()
                ->whereNotIn('id', $existingSeriesIds)
                ->delete();

            // Regenerate product slugs if brand name changed
            if ($originalName !== $brand->name) {
                $products = Product::where('brand_id', $brand->id)->get();

                foreach ($products as $product) {
                    $product->generateSlug();
                    $product->save();
                }

                // chunking-results
                // Product::where('brand_id', $brand->id)
                //     ->chunk(200, function ($products) {
                //         foreach ($products as $product) {
                //             $product->generateSlug();
                //             $product->save();
                //         }
                //     });
            }

            DB::commit();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Brand updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating brand: ' . $e->getMessage());
        }
    }
}
