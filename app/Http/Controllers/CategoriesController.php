<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new category with the provided name
        Category::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', [
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
            return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diperbarui.');
        } else {
            // Redirect back with an error message
            return redirect()->route('admin.categories')->with('error', 'Kategori tidak ditemukan.');
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
