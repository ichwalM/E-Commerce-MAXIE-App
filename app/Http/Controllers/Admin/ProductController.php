<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('stock')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_admin' => 'required|numeric|min:0',
            'price_retail' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'initial_stock' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            
            // Encode to WebP with 80% quality
            $encoded = $image->toWebp(80);
            
            // Generate filename
            $filename = 'products/' . Str::random(40) . '.webp';
            
            // Save to storage
            Storage::disk('public')->put($filename, (string) $encoded);
            $imagePath = $filename;
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'description' => $request->description,
            'price_admin' => $request->price_admin,
            'price_retail' => $request->price_retail,
            'image_path' => $imagePath,
            'is_active' => true,
        ]);

        ProductStock::create([
            'product_id' => $product->id,
            'quantity' => $request->initial_stock ?? 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_admin' => 'required|numeric|min:0',
            'price_retail' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            
            $encoded = $image->toWebp(80);
            $filename = 'products/' . Str::random(40) . '.webp';
            
            Storage::disk('public')->put($filename, (string) $encoded);
            $product->image_path = $filename;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_admin' => $request->price_admin,
            'price_retail' => $request->price_retail,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
