<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order')->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'order'       => 'nullable|integer',
        ]);

        $data['image'] = $request->file('image')->store('products', 'public');
        $data['is_featured'] = $request->boolean('is_featured');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:150',
            'category'    => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'order'       => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $data['is_featured'] = $request->boolean('is_featured');

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk dihapus.');
    }
}
