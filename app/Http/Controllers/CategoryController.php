<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|string',
            'product_id' => 'required|string', // Tambahkan 'exists:products,product_id' jika perlu
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Data telah berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|string',
            'product_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $category->update($validated);

        return response()->json([
            'message' => 'Data telah berhasil diupdate',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
