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
        $shipping_cost = ShippingCosts::find($id);
        return view('admin.shipping_costs.edit', [
            'shipping_cost' => $shipping_cost,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'kota' => 'required|string|max:255',
            'shipping_cost' => 'required|numeric',
        ]);

        // Find the shipping cost by ID
        $shipping_cost = ShippingCosts::find($id);

        // Check if the shipping cost exists
        if ($shipping_cost) {
            // Update the shipping cost with the provided data
            $shipping_cost->update([
                'kota' => $request->input('kota'),
                'shipping_cost' => $request->input('shipping_cost')
            ]);

            // Redirect back with a success message
            return redirect()->route('admin.shipping_costs')->with('success', 'Biaya Pengiriman berhasil diperbarui.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.shipping_costs')->with('error', 'Biaya Pengiriman tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        // Find the shipping cost by ID
        $shipping_cost = ShippingCosts::find($id);

        // Check if the shipping cost exists
        if ($shipping_cost) {
            // Delete the shipping cost
            $shipping_cost->delete();

            // Redirect back with a success message
            return redirect()->route('admin.shipping_costs')->with('success', 'Biaya Pengiriman berhasil dihapus.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.shipping_costs')->with('error', 'Biaya Pengiriman tidak ditemukan.');
        }
    }
}
