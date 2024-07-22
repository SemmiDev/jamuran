<?php

namespace App\Http\Controllers;

use App\DataTables\ProductsDataTable;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    public function create()
    {
        $categories = Category::latest()->get();

        $merchants = Product::distinct()->pluck('owner_name');
        return view('admin.products.create', compact('categories', 'merchants'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        // Check if a photo is uploaded
        if ($request->hasFile('photo')) {
            // Store the photo in the 'public/photos' directory
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        // Create a new product with the provided data
        Product::create([
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'photo' => $photoPath,
            'owner_name' => $request->input('owner_name'),
            'category_id' => $request->input('category_id'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.products')->with('success', 'Produk berhasil dibuat.');
    }

    public function edit($id)
    {
        $product = Product::with(['category'])->find($id);
        $categories = Category::all();
        $merchants = Product::distinct()->pluck('owner_name');
        return view('admin.products.edit', compact('product', 'categories', 'merchants'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'owner_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if ($product) {
            // Check if a photo is uploaded
            if ($request->hasFile('photo')) {
                // Store the photo in the 'public/photos' directory
                $photoPath = $request->file('photo')->store('photos', 'public');
            } else {
                $photoPath = $product->photo;
            }

            // Update the product with the provided data
            $product->update([
                'product_name' => $request->input('product_name'),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'stock' => $request->input('stock'),
                'photo' => $photoPath,
                'owner_name' => $request->input('owner_name'),
                'category_id' => $request->input('category_id'),
            ]);

            // Redirect back with a success message
            return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.products')->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if the product exists
        if ($product) {
            // Delete the product
            $product->delete();

            // Redirect back with a success message
            return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.products')->with('success', 'Produk tidak ditemukan.');
        }
    }
}
