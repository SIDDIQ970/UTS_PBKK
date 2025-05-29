<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Menampilkan semua produk beserta kategorinya
        $products = Product::with('category')->get();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|string'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Data telah berhasil ditambahkan',
            'data' => $product
        ], 201);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|string'
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $product->update($request->all());

        return response()->json([
            'message' => 'Data telah berhasil diupdate',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
