<?php

namespace App\Http\Controllers;

use App\DataTables\ShippingCostsDataTable;
use App\Models\ShippingCosts;
use Illuminate\Http\Request;

class ShippingCostsController extends Controller
{
    public function index(ShippingCostsDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping_costs.index');
    }

    public function create()
    {
        return view('admin.shipping_costs.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'kota' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric',
        ]);

        // Create a new category with the provided name
        ShippingCosts::create([
            'kota' => $request->input('kota'),
            'shipping_cost' => $request->input('shipping_cost')
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.shipping_costs')->with('success', 'Biaya Pengiriman berhasil dibuat.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.shipping_costs.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $category = Category::find($id);

        // Check if the category exists
        if ($category) {
            // Update the category with the provided name
            $category->update([
                'name' => $request->input('name'),
            ]);

            // Redirect back with a success message
            return redirect()->route('admin.shipping_costs')->with('success', 'Kategori berhasil diperbarui.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.shipping_costs')->with('error', 'Kategori tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        // Find the category by ID
        $category = Category::find($id);

        // Check if the category exists
        if ($category) {
            // Delete the category
            $category->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }
    }
}
