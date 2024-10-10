<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('superadmin.pages.data-master.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'title' => 'required|unique:categories|max:255',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Membuat slug berdasarkan judul
            $validated['slug'] = Str::slug($request->title);

            // Proses upload gambar jika ada
            if ($request->hasFile('icon')) {
                $validated['icon'] = $request->file('icon')->store('icons', 'public');
            }

            // Simpan kategori ke database
            Category::create($validated);

            return redirect()->route('superadmin.data-master.category.index')->with('success', 'Category created successfully.');
        } catch (Exception $e) {
            Log::error('Failed to create store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.category.index')->with('error', 'Failed to create category: ' . $e->getMessage());
        }
  }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        try {
           // Validasi input
            $validated = $request->validate([
                'title' => 'required|max:255|unique:categories,title,' . $category->id,
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Update slug berdasarkan judul baru
            $validated['slug'] = Str::slug($request->title);

            // Proses upload gambar baru jika ada
            if ($request->hasFile('icon')) {
                // Hapus ikon lama jika ada
                if ($category->icon) {
                    Storage::disk('public')->delete($category->icon);
                }
                // Simpan ikon baru
                $validated['icon'] = $request->file('icon')->store('icons', 'public');
            }

            // Update kategori
            $category->update($validated);

            return redirect()->route('superadmin.data-master.category.index')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            Log::error('Failed to create store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.category.index')->with('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        try {
            // Hapus ikon jika ada
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }

            // Hapus kategori
            $category->delete();

            return redirect()->route('superadmin.data-master.category.index')->with('success', 'Category  deleted successfully.');
        } catch (Exception $e) {
            Log::error('Failed to delete user and related store: ' . $e->getMessage());
            return redirect()->route('superadmin.data-master.category.index')->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
